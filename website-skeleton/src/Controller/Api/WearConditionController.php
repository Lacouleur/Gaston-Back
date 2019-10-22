<?php

namespace App\Controller\Api;

use App\Entity\WearCondition;
use App\Repository\WearConditionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class WearConditionController extends AbstractController
{
    /**
     * @Route("/wear-condition/{id}", name="get_wearCondition", methods={"GET"})
     */
    public function apiGetWearCondition(WearCondition $wearCondition = null, SerializerInterface $serializer)
    {
        if (!$wearCondition) {
            throw $this->createNotFoundException(
                'Wear-condition not found'
            );
        }

        $jsonData = $serializer->serialize($wearCondition, 'json', [
            'groups' => 'wearCondition_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/wear-conditions", name="get_wearConditions", methods={"GET"})
     */
    public function apiGetWearConditions(WearConditionRepository $wearConditionRepository, SerializerInterface $serializer)
    {
        $wearConditions = $wearConditionRepository->findAll();
        
        $jsonData = $serializer->serialize($wearConditions, 'json', [
            'groups' => 'wearCondition_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }
}