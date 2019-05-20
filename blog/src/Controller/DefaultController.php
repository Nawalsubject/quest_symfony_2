<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->random();

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($article['id']);

        $tags = $article->getTags();

        $category = $article->getCategory();

        return $this->render('/default.html.twig', [
            'article' => $article,
            'tags' => $tags,
            'category' => $category,
        ]);
    }
}
