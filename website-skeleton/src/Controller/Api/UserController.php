<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
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

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/users", name="get_users", methods={"GET"})
     */
    public function apiGetUsers(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $users = $userRepository->findAll();
        
        $jsonData = $serializer->serialize($users, 'json', [
            'groups' => 'user_get',
        ]);

    //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/user-new", name="create_user", methods={"GET","POST"})
     */
    public function apiCreateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $user = $serializer->deserialize($jsonData, User::class, 'json');

        $this->passwordEncoder = $passwordEncoder;
        $encodedPassword = $this->passwordEncoder->encodePassword($user, ':password');

        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('L\'utilisateur à été créé');
    }

}