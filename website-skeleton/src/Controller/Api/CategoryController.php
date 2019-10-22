<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="get_category", methods={"GET"})
     */
    public function apiGetCategory(Category $category = null, SerializerInterface $serializer)
    {
        if (!$category) {
            throw $this->createNotFoundException(
                'Category not found'
            );
        }

        $jsonData = $serializer->serialize($category, 'json', [
            'groups' => 'category_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }

    /**
     * @Route("/categories", name="get_categories", methods={"GET"})
     */
    public function apiGetCategories(CategoryRepository $categoryRepository, SerializerInterface $serializer)
    {
        $categories = $categoryRepository->findAll();
        
        $jsonData = $serializer->serialize($categories, 'json', [
            'groups' => 'category_get',
        ]);

        //dd($jsonData);

        return new Response($jsonData);
    }
}