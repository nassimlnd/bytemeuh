<?php

declare(strict_types=1);

namespace App\Controller;

use App\Data\ArticleData;
use App\Entity\Article;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $articles = ArticleData::getArticles();

        return $this->render('index.html.twig',
            ['articles' => $articles]
        );
    }
}
