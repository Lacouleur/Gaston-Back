<?php

namespace App\Controller\Api;

use App\Entity\Visibility;
use App\Repository\VisibilityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class VisibilityController extends AbstractController
{
    /**
     * @Route("/visibility/{id}", name="get_visibility", methods={"GET"})
     */
    public function apiGetVisibility(Visibility $visibility = null, SerializerInterface $serializer)
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
    public function apiGetvisibilities(VisibilityRepository $visibilityRepository, SerializerInterface $serializer)
    {
        $visibilities = $visibilityRepository->findAll();
        
        $jsonData = $serializer->serialize($visibilities, 'json', [
            'groups' => 'visibility_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }
}
