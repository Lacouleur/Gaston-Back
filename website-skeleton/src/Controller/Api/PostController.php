<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/post/{id}", name="get_post", methods={"GET"})
     */
    public function apiGetPost(Post $post = null, SerializerInterface $serializer)
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
    public function apiGetPosts(PostRepository $postRepository, SerializerInterface $serializer)
    {
        $posts = $postRepository->findAll();

        $jsonData = $serializer->serialize($posts, 'json', [
            'groups' => 'post_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/posts-close", name="close_posts", methods={"GET","POST"})
     */
    public function apiClosePosts(Request $request, PostRepository $postRepository, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $post = $serializer->deserialize($jsonData, Post::class, 'json');
        $lat = $post->getLat();
        $lng = $post->getLng();
        //dd($lat, $lng);
        $closePosts = $postRepository->findAllClosePosts($lat, $lng);

        $jsonData = $serializer->serialize($closePosts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }
}