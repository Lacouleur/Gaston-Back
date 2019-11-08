<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Entity\Commentary;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
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

    private function apiAddPicture(Request $request, Post $post)
    {
        /** @var UploadedFile $picture */
        $picture = $request->files->get('image');
        
        if ($picture) {
            $file = pathinfo($picture->getClientOriginalName());
            $filename = 'post_' . $post->getId() . '.' . $file['extension'];

            $picture->move(
                $this->getParameter('pictures_directory'),
            $filename
            );

            $picture = Image::make($this->getParameter('pictures_directory') . '/' . $filename)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($this->getParameter('pictures_directory') . '/' . $filename);

            $post->setPicture($filename);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($post);
        $entityManager->flush();
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
    public function apiCreatePost(Request $request, UserRepository $userRepository, SerializerInterface $serializer, 
    CategoryRepository $categoryRepository, ValidatorInterface $validator, UserInterface $userInterface)
    {
        $data = $request->request;

        $categoryLabel = $data->get('category');
        $title = $data->get('title');
        $description = $data->get('description');
        $addressLabel = $data->get('addressLabel');
        $lat = floatval($data->get('lat'));
        $lng = floatval($data->get('lng'));

        $category = $categoryRepository->findOneByLabel($categoryLabel);
        $user = $userRepository->findOneByUsername($userInterface->getUsername());

        $post = new Post;
        
        $post->setCategory($category);
        $post->setUser($user);
        $post->setTitle($title);
        $post->setDescription($description);
        $post->setAddressLabel($addressLabel);
        $post->setLat($lat);
        $post->setLng($lng);

        $errors = $validator->validate($post);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        $this->apiAddPicture($request, $post);

        $jsonData = $serializer->serialize($post, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }

    /**
     * @Route("/post/{id}/edit", name="edit_post", methods={"GET","POST"})
     */
    public function apiEditPost(Request $request, Post $post = null, CategoryRepository $categoryRepository, ValidatorInterface $validator, 
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

        $data = $request->request;

        $categoryLabel = $data->get('category');
        $title = $data->get('title');
        $description = $data->get('description');
        $addressLabel = $data->get('addressLabel');
        $lat = floatval($data->get('lat'));
        $lng = floatval($data->get('lng'));

        if ($categoryLabel) {
            $category = $categoryRepository->findOneByLabel($categoryLabel);
            $post->setCategory($category);
        }
        if ($title) {
            $post->setTitle($title);
        }
        if ($description) {
            $post->setDescription($description);
        }
        if ($addressLabel) {
            $post->setAddressLabel($addressLabel);
            $post->setLat($lat);
            $post->setLng($lng);
        }

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

        $this->apiAddPicture($request, $post);

        return new JsonResponse(['success' => 'The post has been modified']);
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

        if ($post->getPicture()) {
            unlink($this->getParameter('pictures_directory') . '/' . $post->getPicture());
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        return new JsonResponse(['success' => 'The post has been deleted']);
    }

    /**
     * @Route("/post/{id}/new-commentary", name="new_commentary", methods={"GET","POST"})
     */
    public function apiNewCommentary(Post $post = null, Request $request, SerializerInterface $serializer, 
    UserRepository $userRepository, ValidatorInterface $validator, UserInterface $userInterface)
    {
        if (!$post) {
            throw $this->createNotFoundException(
                'Post not found'
            );
        }

        $jsonData = $request->getContent();

        $user = $userRepository->findOneByUsername($userInterface->getUsername());

        $commentary = $serializer->deserialize($jsonData, Commentary::class, 'json');
        $commentary->setUser($user);
        $commentary->setPost($post);
        
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

        return new JsonResponse(['success' => 'The commentary has been added']);
    }
}