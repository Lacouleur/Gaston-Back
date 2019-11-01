<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Entity\Commentary;
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
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api", name="api_")
 */
class PostController extends AbstractController
{
    private function apiIsSameUser(Post $post, UserInterface $userInterface, UserRepository $userRepository)
    {
        $postUser = $post->getUser();
        $currentUser = $userRepository->findOneByUsername($userInterface->getUsername());
        
        if ($currentUser !== $postUser) {
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

    /**
     * @Route("/posts", name="get_posts", methods={"GET"})
     */
    public function apiGetPosts(PostRepository $postRepository, SerializerInterface $serializer)
    {
        $posts = $postRepository->findAll();

        $jsonData = $serializer->serialize($posts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }

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

        return new Response($jsonData);
    }

    /**
     * @Route("/post-new", name="create_post", methods={"POST"})
     */
    public function apiCreatePost(Request $request, SerializerInterface $serializer, UserRepository $userRepository, 
    PostStatusRepository $postStatusRepository, VisibilityRepository $visibilityRepository, WearConditionRepository $wearConditionRepository, 
    CategoryRepository $categoryRepository, ValidatorInterface $validator, UserInterface $userInterface)
    {
        $jsonData = $request->getContent();

        $post = $serializer->deserialize($jsonData, Post::class, 'json');

        $user = $userRepository->findOneByUsername($userInterface->getUsername());
        $post->setUser($user);

        $errors = $validator->validate($post);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $parsed_json = json_decode($jsonData);

        $postStatusId = $parsed_json->{'postStatus'}->{'id'};
        $visibilityId = $parsed_json->{'visibility'}->{'id'};
        $wearConditionId = $parsed_json->{'wearCondition'}->{'id'};
        $categoryId = $parsed_json->{'category'}->{'id'};

        $postStatus = $postStatusRepository->find($postStatusId);
        $post->setPostStatus($postStatus);
        $visibility = $visibilityRepository->find($visibilityId);
        $post->setVisibility($visibility);
        $wearCondition = $wearConditionRepository->find($wearConditionId);
        $post->setWearCondition($wearCondition);
        $category = $categoryRepository->find($categoryId);
        $post->setCategory($category);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Le post a été créé']);
    }

    /**
     * @Route("/post/{id}/edit", name="edit_post", methods={"GET","PUT"})
     */
    public function apiEditPost(Request $request, Post $post = null, SerializerInterface $serializer, 
    PostStatusRepository $postStatusRepository, VisibilityRepository $visibilityRepository, 
    WearConditionRepository $wearConditionRepository, CategoryRepository $categoryRepository, ValidatorInterface $validator, 
    UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        if (!$this->apiIsSameUser($post, $userInterface, $userRepository) && !$this->apiIsAdmin($userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
        }

        $jsonData = $request->getContent();

        $postUpdate = $serializer->deserialize($jsonData, Post::class, 'json');

        $parsed_json = json_decode($jsonData);

        $postStatusId = $parsed_json->{'postStatus'}->{'id'};
        $visibilityId = $parsed_json->{'visibility'}->{'id'};
        $wearConditionId = $parsed_json->{'wearCondition'}->{'id'};
        $categoryId = $parsed_json->{'category'}->{'id'};

        $postStatus = $postStatusRepository->find($postStatusId);
        $post->setPostStatus($postStatus);
        $visibility = $visibilityRepository->find($visibilityId);
        $post->setVisibility($visibility);
        $wearCondition = $wearConditionRepository->find($wearConditionId);
        $post->setWearCondition($wearCondition);
        $category = $categoryRepository->find($categoryId);
        $post->setCategory($category);

        $postTitle = $postUpdate->getTitle();
        $post->setTitle($postTitle);
        $postDescription = $postUpdate->getDescription();
        $post->setDescription($postDescription);
        $postAddressLabel = $postUpdate->getAddressLabel();
        $post->setAddressLabel($postAddressLabel);
        $postLat = $postUpdate->getLat();
        $post->setLat($postLat);
        $postLng = $postUpdate->getLng();
        $post->setLng($postLng);

        $errors = $validator->validate($post);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($post);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Le post a été modifié']);
    }

    /**
     * @Route("/post/{id}/new-picture", name="new_picture_post", methods={"GET","POST"})
     */
    public function apiNewPicturePost(Request $request, Post $post = null, UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        if (!$this->apiIsSameUser($post, $userInterface, $userRepository) && !$this->apiIsAdmin($userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
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
                
                $post->setPicture($filename);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->merge($post);
                $entityManager->flush(); 

                return new JsonResponse(['success' => 'L\'image est stockée']);

            } catch (FileException $e) {
                // ... handle exception if something happens during file uploadf8f3577217a7fb6b58745689a06a1405
            }
        }

        return new JsonResponse(['fail' => 'Pas d\'image']);
    }

    /**
     * @Route("/post/{id}", name="delete_post", methods={"DELETE"})
     */
    public function apiDeletePost(Post $post = null, UserInterface $userInterface, UserRepository $userRepository)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        if (!$this->apiIsSameUser($post, $userInterface, $userRepository) && !$this->apiIsAdmin($userInterface, $userRepository)) {
            throw $this->createAccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Le post a été supprimé']);
    }

    /**
     * @Route("/post/{id}/new-commentary", name="new_commentary", methods={"GET","POST"})
     */
    public function apiNewCommentary(Post $post = null, Request $request, SerializerInterface $serializer, 
    UserRepository $userRepository, ValidatorInterface $validator)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        $jsonData = $request->getContent();

        $parsed_json = json_decode($jsonData);
        $userId = $parsed_json->{'user'};
        $user = $userRepository->find($userId);

        $commentary = $serializer->deserialize($jsonData, Commentary::class, 'json');
        $commentary->setPost($post);
        $commentary->setUser($user);

        $errors = $validator->validate($commentary);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentary);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Le commentaire a été créé']);
    }

    /**
     * @Route("/post/{id}/close", name="close_post", methods={"GET"})
     */
    public function apiClosePosts(Post $post = null, PostRepository $postRepository, SerializerInterface $serializer)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }
        
        $lat = $post->getLat();
        $lng = $post->getLng();

        $closePosts = $postRepository->findAllClosePosts($lat, $lng);

        $jsonData = $serializer->serialize($closePosts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }
}