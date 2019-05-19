<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="tag_index")
     */
    public function index()
    {
        $tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{name}", name="tag_show")
     * @param Tag $tag
     * @return Response
     */
    public function show(?Tag $tag): Response
    {
        if (!$tag) {
            throw $this
                ->createNotFoundException('No articles with this tag.');
        }

        $articles = $tag->getArticles();

        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}
