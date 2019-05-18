<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Form\ArticleSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        $form = $this->createForm(
            ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/show/{slug}", name="blog_show", requirements={"slug"="[a-z-0-9]*"})
     * @param string $slug
     * @return Response
     */
    public function showArticles(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace('/-/', ' ', ucwords(trim(strip_tags($slug)), "-"));

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        $category = $article->getCategory();

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
                'category' => $category
            ]
        );
    }

    /**
     * @Route("/blog/category/{name}", name="blog_show_category")
     * @param Category $category
     * @return Response
     */
    public function showByCategory(Category $category): Response
    {
        if (!$category) {
            throw $this
                ->createNotFoundException('No category has been sent to find a category in article\'s table.');
        }

        $articles = $category->getArticles();

        return $this->render('blog/category.html.twig', ['articles' => $articles, 'category' => $category]);
    }

    /**
     * @Route("/blog/tag/{name}", name="blog_tag")
     * @param Tag $tag
     * @return Response
     */
    public function showTags(?Tag $tag): Response
    {
        if (!$tag) {
            throw $this
                ->createNotFoundException('No articles with this tag.');
        }

        $articles = $tag->getArticles();

        return $this->render('blog/tag.html.twig', [
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}
