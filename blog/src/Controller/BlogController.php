<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Nawal',
        ]);
    }

    /**
     * @Route("/blog/show/{slug}", name="blog_show", requirements={"slug"="[a-z-0-9]*"})
     * @param $slug
     * @return Response
     */
    public function show($slug="article-sans-titre")
    {
        $slug = str_replace('-',' ',$slug);
        $slug = ucwords($slug);

        return $this->render('blog/show.html.twig', ['slug' => $slug]);
    }
}
