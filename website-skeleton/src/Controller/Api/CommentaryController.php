<?php

namespace App\Controller\Api;

use App\Entity\Commentary;
use App\Repository\CommentaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class CommentaryController extends AbstractController
{
    /**
     * @Route("/commentary/{id}", name="get_commentary", methods={"GET"})
     */
    public function apiGetCommentary(Commentary $commentary = null, SerializerInterface $serializer)
    {
        if (!$commentary) {
            throw $this->createNotFoundException(
                'Commentary not found'
            );
        }

        $jsonData = $serializer->serialize($commentary, 'json', [
            'groups' => 'commentary_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

}