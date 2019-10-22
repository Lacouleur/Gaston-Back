<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\PostStatus;
use App\Entity\User;
use App\Entity\Visibility;
use App\Entity\WearCondition;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Repository\PostStatusRepository;
use App\Repository\UserRepository;
use App\Repository\VisibilityRepository;
use App\Repository\WearConditionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/dumpster", name="dumpster_")
 */
class DumpsterController extends AbstractController
{
    /**
     * @Route("/", name="dumpster_index")
     */
    public function index()
    {
        return $this->render('dumpster/index.html.twig', [
            'controller_name' => 'DumpsterController',
        ]);
    }

    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function dumpsterGetUser(User $user = null, SerializerInterface $serializer)
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
    public function dumpsterGetUsers(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $users = $userRepository->findAll();
        
        $jsonData = $serializer->serialize($users, 'json', [
            'groups' => 'user_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    ///**
    // * @Route("/user/new", name="create_user", methods={"POST"})
    // */
    //public function dumpsterCreateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    //{
    //    $this->passwordEncoder = $passwordEncoder;
//
    //    $user = new User();
    //    $user->setUsername();
    //    $user->setEmail();
    //    $encodedPassword = $this->passwordEncoder->encodePassword($user, 'admin');
    //    $user->setPassword($encodedPassword);
    //    $user->setAddressLabel();
    //    $user->setLat();
    //    $user->setLng();
    //    $user->setRoles(['ROLE_USER']);
//
    //    $entityManager = $this->getDoctrine()->getManager();
    //    $entityManager->persist($user);
    //    $entityManager->flush();
//
    //    return $this->redirectToRoute('user_index');
//
    //}

    /**
     * @Route("/post/{id}", name="get_post", methods={"GET"})
     */
    public function dumpsterGetPost(Post $post = null, SerializerInterface $serializer)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        $jsonData = $serializer->serialize($post, 'json', [
            'groups' => 'post_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/posts", name="get_posts", methods={"GET"})
     */
    public function dumpsterGetPosts(PostRepository $postRepository, SerializerInterface $serializer)
    {
        $posts = $postRepository->findAll();

        $jsonData = $serializer->serialize($posts, 'json', [
            'groups' => 'post_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/category/{id}", name="get_category", methods={"GET"})
     */
    public function dumpsterGetCategory(Category $category = null, SerializerInterface $serializer)
    {
        if (!$category) {
            throw $this->createNotFoundException(
                'Category not found'
            );
        }

        $jsonData = $serializer->serialize($category, 'json', [
            'groups' => 'category_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/categories", name="get_categories", methods={"GET"})
     */
    public function dumpsterGetCategories(CategoryRepository $categoryRepository, SerializerInterface $serializer)
    {
        $categories = $categoryRepository->findAll();
        
        $jsonData = $serializer->serialize($categories, 'json', [
            'groups' => 'category_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/wear-condition/{id}", name="get_wearCondition", methods={"GET"})
     */
    public function dumpsterGetWearCondition(WearCondition $wearCondition = null, SerializerInterface $serializer)
    {
        if (!$wearCondition) {
            throw $this->createNotFoundException(
                'Wear-condition not found'
            );
        }

        $jsonData = $serializer->serialize($wearCondition, 'json', [
            'groups' => 'wearCondition_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/wear-conditions", name="get_wearConditions", methods={"GET"})
     */
    public function dumpsterGetWearConditions(WearConditionRepository $wearConditionRepository, SerializerInterface $serializer)
    {
        $wearConditions = $wearConditionRepository->findAll();
        
        $jsonData = $serializer->serialize($wearConditions, 'json', [
            'groups' => 'wearCondition_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/post-status/{id}", name="get_postStatus", methods={"GET"})
     */
    public function dumpsterGetPostStatus(PostStatus $postStatus = null, SerializerInterface $serializer)
    {
        if (!$postStatus) {
            throw $this->createNotFoundException(
                'Post-status not found'
            );
        }

        $jsonData = $serializer->serialize($postStatus, 'json', [
            'groups' => 'postStatus_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/post-statutes", name="get_postStatutes", methods={"GET"})
     */
    public function dumpsterGetPostStatutes(PostStatusRepository $postStatusRepository, SerializerInterface $serializer)
    {
        $postStatutes = $postStatusRepository->findAll();
        
        $jsonData = $serializer->serialize($postStatutes, 'json', [
            'groups' => 'postStatus_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/visibility/{id}", name="get_visibility", methods={"GET"})
     */
    public function dumpsterGetVisibility(Visibility $visibility = null, SerializerInterface $serializer)
    {
        if (!$visibility) {
            throw $this->createNotFoundException(
                'Visibility not found'
            );
        }

        $jsonData = $serializer->serialize($visibility, 'json', [
            'groups' => 'visibility_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/visibilities", name="get_visibilities", methods={"GET"})
     */
    public function dumpsterGetvisibilities(VisibilityRepository $visibilityRepository, SerializerInterface $serializer)
    {
        $visibilities = $visibilityRepository->findAll();
        
        $jsonData = $serializer->serialize($visibilities, 'json', [
            'groups' => 'visibility_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }
}
