<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/article/{slug}', name: 'about')]
    public function article(#[MapEntity(mapping: ['slug' => 'slug'])] Article $article): Response
    {
        return $this->render('article.html.twig', [
            'article' => $article,
        ]);
    }
}
