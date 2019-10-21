<?php

namespace App\Controller;

use App\Entity\WearCondition;
use App\Form\WearConditionType;
use App\Repository\WearConditionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wear/condition")
 */
class WearConditionController extends AbstractController
{
    /**
     * @Route("/", name="wear_condition_index", methods={"GET"})
     */
    public function index(WearConditionRepository $wearConditionRepository): Response
    {
        return $this->render('wear_condition/index.html.twig', [
            'wear_conditions' => $wearConditionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="wear_condition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wearCondition = new WearCondition();
        $form = $this->createForm(WearConditionType::class, $wearCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wearCondition);
            $entityManager->flush();

            return $this->redirectToRoute('wear_condition_index');
        }

        return $this->render('wear_condition/new.html.twig', [
            'wear_condition' => $wearCondition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wear_condition_show", methods={"GET"})
     */
    public function show(WearCondition $wearCondition): Response
    {
        return $this->render('wear_condition/show.html.twig', [
            'wear_condition' => $wearCondition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wear_condition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WearCondition $wearCondition): Response
    {
        $form = $this->createForm(WearConditionType::class, $wearCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wear_condition_index');
        }

        return $this->render('wear_condition/edit.html.twig', [
            'wear_condition' => $wearCondition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wear_condition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WearCondition $wearCondition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wearCondition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wearCondition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wear_condition_index');
    }
}
