<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_index")
     */
    public function index(Request $request) : Response
    {
        $session = new Session();

        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        if ($form->isSubmitted()) {
            $categoryManager = $this->getDoctrine()->getManager();
            $categoryManager->persist($category);
            $categoryManager->flush();

            $session->getFlashBag()->add(
                'success',
                'The category has been successfully added !'
            );

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/{name}", name="category_show")
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        if (!$category) {
            throw $this
                ->createNotFoundException('No category has been sent to find a category in article\'s table.');
        }

        $articles = $category->getArticles();

        return $this->render('category/show.html.twig', ['articles' => $articles, 'category' => $category]);
    }
}
