<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\PostStatus;
use App\Entity\User;
use App\Entity\Visibility;
use App\Entity\WearCondition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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
    public function dumpsterGetUser(User $user, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($user, 'json', [
            'groups' => 'user_get',
        ]);

        //dd($jsonData);

        return $jsonData;
    }

    /**
     * @Route("/post/{id}", name="get_post", methods={"GET"})
     */
    public function dumpsterGetPost(Post $post, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($post, 'json', [
            'groups' => 'post_get',
        ]);

        //dd($jsonData);

        return $jsonData;
    }

    /**
     * @Route("/category/{id}", name="get_category", methods={"GET"})
     */
    public function dumpsterGetCategory(Category $category, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($category, 'json', [
            'groups' => 'category_get',
        ]);

        //dd($jsonData);

        return $jsonData;
    }

    /**
     * @Route("/wear-condition/{id}", name="get_wearCondition", methods={"GET"})
     */
    public function dumpsterGetWearCondition(WearCondition $wearCondition, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($wearCondition, 'json', [
            'groups' => 'wearCondition_get',
        ]);

        //dd($jsonData);

        return $jsonData;
    }

    /**
     * @Route("/post-status/{id}", name="get_postStatus", methods={"GET"})
     */
    public function dumpsterGetPostStatus(PostStatus $postStatus, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($postStatus, 'json', [
            'groups' => 'postStatus_get',
        ]);

        //dd($jsonData);

        return $jsonData;
    }

    /**
     * @Route("/visibility/{id}", name="get_visibility", methods={"GET"})
     */
    public function dumpsterGetVisibility(Visibility $visibility, SerializerInterface $serializer)
    {
        $jsonData = $serializer->serialize($visibility, 'json', [
            'groups' => 'visibility_get',
        ]);

        dd($jsonData);

        //return $jsonData;
    }
}
