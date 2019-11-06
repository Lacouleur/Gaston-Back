<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route(name="api_")
 */
class UserController extends AbstractController
{
    private function apiIsSameUser(User $user, UserInterface $userInterface, UserRepository $userRepository)
    {
        $currentUser = $userRepository->findOneByUsername($userInterface->getUsername());
        
        if ($currentUser !== $user) {
            return false;
        } else {
            return true;
          }
    }

    private function apiIsAdmin(UserInterface $userInterface, UserRepository $userRepository)
    {
        $currentUser = $userRepository->findOneByUsername($userInterface->getUsername());
        
        $roles = $currentUser->getRoles();

        if (is_array($roles) && in_array('ROLE_ADMIN', $roles)) {
          return true;
        } else {
          return false;
        }
    }

    private function apiAddPicture(Request $request, User $user)
    {
        /** @var UploadedFile $picture */
        $picture = $request->files->get('image');
        
        if ($picture) {
            $file = pathinfo($picture->getClientOriginalName());
            $filename = 'user_' . $user->getId() . '.' . $file['extension'];

            $picture->move(
                $this->getParameter('pictures_directory'),
            $filename
            );

            $picture = Image::make($this->getParameter('pictures_directory') . '/' . $filename)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($this->getParameter('pictures_directory') . '/' . $filename);

            $user->setPicture('http://alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/uploads/pictures/' . $filename);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($user);
        $entityManager->flush();
    }

    /**
     * @Route("/api/user/{id}", name="get_user", methods={"GET"})
     */
    public function apiGetUser(User $user = null, SerializerInterface $serializer, UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }

        if (!$this->apiIsSameUser($user, $userInterface, $userRepository) && !$this->apiIsAdmin($userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
        }

        $jsonData = $serializer->serialize($user, 'json', [
            'groups' => 'user_get',
        ]);


        return new Response($jsonData);
    }

    /**
     * @Route("/user-new", name="create_user", methods={"GET","POST"})
     */
    public function apiCreateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonData = $request->getContent();

        $user = $serializer->deserialize($jsonData, User::class, 'json');

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            $jsonErrors = [];

            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $password = $user->getPassword();
        
        $this->passwordEncoder = $passwordEncoder;
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);

        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['success' => 'The user has been created']);
    }

    /**
     * @Route("/api/user/{id}/edit", name="edit_user", methods={"GET","PUT"})
     */
    public function apiEditUser(Request $request, User $user = null, SerializerInterface $serializer, ValidatorInterface $validator, UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }

        if (!$this->apiIsSameUser($user, $userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
        }

        $data = $request->request;

    
        $email = $data->get('email');
        $firstname = $data->get('firstname');
        $lastname = $data->get('lastname');
        $phoneNumber = $data->get('phoneNumber');
        $organisation = $data->get('organisation');
        $description = $data->get('description');
        $addressLabel = $data->get('addressLabel');;
        $lat = $data->get('lat');
        $lng = $data->get('lng');

        if ($email) {
            $user->setEmail($email);
        }
        if ($firstname) {
            $user->setFirstname($firstname);
        }
        if ($lastname) {
            $user->setLastname($lastname);
        }
        if ($phoneNumber) {
            $user->setPhoneNumber($phoneNumber);
        }
        if ($organisation) {
            $user->setOrganisation($organisation);
        }
        if ($description) {
            $user->setDescription($description);
        }
        if ($addressLabel) {
            $user->setAddressLabel($addressLabel);
            $user->setLat($lat);
            $user->setLng($lng);
        }

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($user);
        $entityManager->flush();

        $this->apiAddPicture($request, $user);

        return new JsonResponse(['success' => 'The user has been modified']);
    }

    /**
     * @Route("/user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function apiDeleteUser(User $user = null, UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }

        if (!$this->apiIsSameUser($user, $userInterface, $userRepository) && !$this->apiIsAdmin($userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
        }

        if ($user->getPicture()) {
            unlink($this->getParameter('pictures_directory') . '/' . $user->getPicture());
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['success' => 'The user has been deleted']);
    }
}