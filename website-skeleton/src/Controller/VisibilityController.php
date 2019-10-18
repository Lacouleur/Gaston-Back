<?php

namespace App\Controller;

use App\Entity\Visibility;
use App\Form\VisibilityType;
use App\Repository\VisibilityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visibility")
 */
class VisibilityController extends AbstractController
{
    /**
     * @Route("/", name="visibility_index", methods={"GET"})
     */
    public function index(VisibilityRepository $visibilityRepository): Response
    {
        return $this->render('visibility/index.html.twig', [
            'visibilities' => $visibilityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="visibility_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $visibility = new Visibility();
        $form = $this->createForm(VisibilityType::class, $visibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visibility);
            $entityManager->flush();

            return $this->redirectToRoute('visibility_index');
        }

        return $this->render('visibility/new.html.twig', [
            'visibility' => $visibility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visibility_show", methods={"GET"})
     */
    public function show(Visibility $visibility): Response
    {
        return $this->render('visibility/show.html.twig', [
            'visibility' => $visibility,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visibility_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visibility $visibility): Response
    {
        $form = $this->createForm(VisibilityType::class, $visibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visibility_index');
        }

        return $this->render('visibility/edit.html.twig', [
            'visibility' => $visibility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visibility_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Visibility $visibility): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visibility->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visibility);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visibility_index');
    }
}
