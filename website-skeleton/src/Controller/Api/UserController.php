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
    public function apiCreateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $user = $serializer->deserialize($jsonData, User::class, 'json');
        $password = $user->getPassword();

        $this->passwordEncoder = $passwordEncoder;
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);

        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('L\'utilisateur à été créé');
    }

    /**
     * @Route("/api/user-picture", name="picture_user", methods={"GET","POST"})
     */
    public function apiPictureUser(Request $request, UserRepository $userRepository)
    {
        /** @var UploadedFile $picture */
        $picture = $request->files->get('image');
        $userId = $request->request->get('userId');

        $user = $userRepository->findById($userId);

        if ($picture) {
            $filename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);

            try {
                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $user[0]->setPicture($filename);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user[0]);
                $entityManager->flush();
    
        }

        return new Response('L\'image est stockée!');
    }

    /**
     * @Route("/api/close/user", name="close_user", methods={"GET","POST"})
     */
    public function apiClosePosts(Request $request, PostRepository $postRepository, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $user = $serializer->deserialize($jsonData, User::class, 'json');
        $lat = $user->getLat();
        $lng = $user->getLng();

        $closePosts = $postRepository->findAllClosePosts($lat, $lng);

        $jsonData = $serializer->serialize($closePosts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }

}