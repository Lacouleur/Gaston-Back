<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function map(Request $request, PostRepository $postRepository, SerializerInterface $serializer)
    {
        $jsonData = $request->getContent();

        $parsed_json = json_decode($jsonData);

        $zoom = $parsed_json->{'zoom'};
        $lat = $parsed_json->{'lat'};
        $lng = $parsed_json->{'lng'};

        $closePosts = $postRepository->findAllClosePosts($lat, $lng, $zoom);

        $jsonData = $serializer->serialize($closePosts, 'json', [
            'groups' => 'post_get',
        ]);

        return new Response($jsonData);
    }
}
