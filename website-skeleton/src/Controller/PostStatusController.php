<?php

namespace App\Controller;

use App\Entity\PostStatus;
use App\Form\PostStatusType;
use App\Repository\PostStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post-status")
 */
class PostStatusController extends AbstractController
{
    /**
     * @Route("/", name="post_status_index", methods={"GET"})
     */
    public function index(PostStatusRepository $postStatusRepository): Response
    {
        return $this->render('post_status/index.html.twig', [
            'post_statuses' => $postStatusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_status_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $postStatus = new PostStatus();
        $form = $this->createForm(PostStatusType::class, $postStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postStatus);
            $entityManager->flush();

            return $this->redirectToRoute('post_status_index');
        }

        return $this->render('post_status/new.html.twig', [
            'post_status' => $postStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_status_show", methods={"GET"})
     */
    public function show(PostStatus $postStatus): Response
    {
        return $this->render('post_status/show.html.twig', [
            'post_status' => $postStatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_status_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PostStatus $postStatus): Response
    {
        $form = $this->createForm(PostStatusType::class, $postStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_status_index');
        }

        return $this->render('post_status/edit.html.twig', [
            'post_status' => $postStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_status_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PostStatus $postStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postStatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_status_index');
    }
}
