<?php

namespace App\Controller\Api;

use App\Entity\PostStatus;
use App\Repository\PostStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class PostStatusController extends AbstractController
{
    /**
     * @Route("/post-status/{id}", name="get_postStatus", methods={"GET"})
     */
    public function apiGetPostStatus(PostStatus $postStatus = null, SerializerInterface $serializer)
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
    public function apiGetPostStatutes(PostStatusRepository $postStatusRepository, SerializerInterface $serializer)
    {
        $postStatutes = $postStatusRepository->findAll();
        
        $jsonData = $serializer->serialize($postStatutes, 'json', [
            'groups' => 'postStatus_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }
}