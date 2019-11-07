<?php

namespace App\Controller\Api;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map", methods={"GET","POST"})
     */
    public function map(Request $request, PostRepository $postRepository, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $parsed_json = json_decode($jsonData);

        $zoom = $parsed_json->{'zoom'};
        $lat = $parsed_json->{'lat'};
        $lng = $parsed_json->{'lng'};

        if ($zoom >= 15) {
            $closePosts = $postRepository->findAllClosePosts($lat, $lng);

            $jsonData = $serializer->serialize($closePosts, 'json', [
                'groups' => 'post_get',
            ]);

            return new Response($jsonData);
        }

        return new JsonResponse(['fail' => 'Too much posts']);
    }
}
