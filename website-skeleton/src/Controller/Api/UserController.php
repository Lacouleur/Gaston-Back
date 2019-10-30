<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route(name="api_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/api/users", name="get_users", methods={"GET"})
     */
    public function apiGetUsers(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $users = $userRepository->findAll();
        
        $jsonData = $serializer->serialize($users, 'json', [
            'groups' => 'user_get',
        ]);


        return new Response($jsonData);
    }
    
    /**
     * @Route("/api/user/{id}", name="get_user", methods={"GET"})
     */
    public function apiGetUser(User $user = null, SerializerInterface $serializer)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
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

        return new Response(json_encode(['success' => 'L\'utilisateur a été créé']));
    }

    /**
     * @Route("/api/user/{id}/edit", name="edit_user", methods={"GET","PUT"})
     */
    public function apiEditUser(Request $request, User $user = null, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }

        $jsonData = $request->getContent();

        $userUpdate = $serializer->deserialize($jsonData, User::class, 'json');

        $userEmail = $userUpdate->getEmail();
        $user->setEmail($userEmail);
        $userFirstname = $userUpdate->getFirstname();
        $user->setFirstname($userFirstname);
        $userLastname = $userUpdate->getLastname();
        $user->setLastname($userLastname);
        $userPhoneNumber = $userUpdate->getPhoneNumber();
        $user->setPhoneNumber($userPhoneNumber);
        $userOrganisation = $userUpdate->getOrganisation();
        $user->setOrganisation($userOrganisation);
        $userDescription = $userUpdate->getDescription();
        $user->setDescription($userDescription);
        $userAddressLabel = $userUpdate->getAddressLabel();
        $user->setAddressLabel($userAddressLabel);
        $userLat = $userUpdate->getLat();
        $user->setLat($userLat);
        $userLng = $userUpdate->getLng();
        $user->setLng($userLng);

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

        return new Response(json_encode(['success' => 'L\'utilisateur a été modifié']));
    }

    /**
     * @Route("/api/user/{id}/new-picture", name="new_picture__user", methods={"GET","POST"})
     */
    public function apiNewPictureUser(Request $request, User $user = null)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }

        /** @var UploadedFile $picture */
        $picture = $request->files->get('image');

        if ($picture) {
            $filename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);

            try {
                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $filename
                );

            $user->setPicture($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($user);
            $entityManager->flush();

            return new Response(json_encode(['success' => 'L\'image est stockée']));

            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }

        return new Response(json_encode(['fail' => 'Pas d\'image']));
    }

    /**
     * @Route("/api/user/{id}/close", name="close_user", methods={"GET"})
     */
    public function apiClosePosts(User $user = null, PostRepository $postRepository, SerializerInterface $serializer)
    {
        if (!$user) {
            throw $this->createNotFoundException(
                'User not found'
            );
        }
        
        $lat = $user->getLat();
        $lng = $user->getLng();

        $closePosts = $postRepository->findAllClosePosts($lat, $lng);

        $jsonData = $serializer->serialize($closePosts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }

}