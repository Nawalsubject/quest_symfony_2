<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @Route("/blog/show/{slug}", name="blog_show", defaults={"slug" = null}, requirements={"slug"="[a-z-0-9]*"})
     * @param string $slug
     * @return Response
     */
    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace('/-/', ' ', ucwords(trim(strip_tags($slug)), "-"));

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @Route("blog/category/{category}", name="blog_show_category")
     * @param Category $category
     * @return Response
     */
    public function showByCategory(Category $category): Response
    {
        /*        $category = $this->getDoctrine()
                            ->getRepository(Category::class)
                            ->findOneByName($category);

                  $articles = $this->getDoctrine()
                            ->getRepository(Article::class)
                            ->findByCategory($category,['id'=> 'DESC'],3);*/

        $categoryName = $category->getName();
        $articles = $category->getArticles();

        return $this->render('blog/category.html.twig', ['articles' => $articles, 'category' => $categoryName]);
    }
}
