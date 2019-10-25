<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        //dd($posts);
        $jsonData = $serializer->serialize($posts, 'json', [
            'groups' => 'post_get',
        ]);
        //dd($jsonData);
        return new Response($jsonData);
    }

    /**
     * @Route("/post-new", name="create_post", methods={"GET","POST"})
     */
    public function apiCreatePost(Request $request, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();
        //dd($jsonData);
        $post = $serializer->deserialize($jsonData, Post::class, 'json');
        dd($post);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        return new Response('Le post à été créé');
    }

    /**
     * @Route("/post-picture", name="picture_post", methods={"GET","POST"})
     */
    public function apiPicturePost(Request $request, PostRepository $postRepository)
    {
        /** @var UploadedFile $picture */
        $picture = $request->files->get('image');
        $postId = $request->request->get('postId');

        $post = $postRepository->findById($postId);
        
        if ($picture) {
            $filename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            try {

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $filename
                );
                
                $post[0]->setPicture($filename);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post[0]);
                $entityManager->flush();

            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }

        return new Response('L\'image est stockée!');
    }

    /**
     * @Route("/close/post", name="close_post", methods={"GET","POST"})
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