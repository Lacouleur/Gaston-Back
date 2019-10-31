<?php

namespace App\Controller\Api;

use App\Entity\Commentary;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        return new Response($jsonData);
    }

    /**
     * @Route("/commentary/{id}/edit", name="edit_commentary", methods={"GET","PUT"})
     */
    public function apiEditComentary(Request $request, Commentary $commentary = null, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        if (!$commentary) {
            throw $this->createNotFoundException(
                'Commentary not found'
            );
        }

        $jsonData = $request->getContent();

        $commentaryUpdate = $serializer->deserialize($jsonData, Commentary::class, 'json');

        $commentaryBody = $commentaryUpdate->getBody();
        $commentary->setBody($commentaryBody);

        $errors = $validator->validate($commentary);

        if (count($errors) > 0) {
            $jsonErrors = [];
            
            foreach ($errors as $error) {
                $jsonErrors[$error->getPropertyPath()] = $error->getMessage();
            }
            
            return $this->json($jsonErrors, 422);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($commentary);
        $entityManager->flush();

        return new Response(json_encode(['success' => 'Le commentaire a été modifié']));
    }

    /**
     * @Route("/commentary/{id}", name="delete_commentary", methods={"DELETE"})
     */
    public function apiDeleteCommentary(Commentary $commentary = null)
    {
        if (!$commentary) {
            throw $this->createNotFoundException(
                'Commentary not found'
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commentary);
        $entityManager->flush();

        return new Response(json_encode(['success' => 'Le commentaire a été supprimé']));
    }

}