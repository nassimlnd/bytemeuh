<?php

namespace App\Controller;

use App\Data\ArticleData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article_index')]
    public function index(): Response
    {
        $articleList = ArticleData::getArticles();

        return $this->render('article/index.html.twig', [
            'articles' => $articleList,
        ]);
    }

    #[Route('/articles/{slug}', name: 'app_article_show')]
    public function show(string $slug): Response
    {
        $articleList = ArticleData::getArticles();
        $article = ArticleData::getArticleBySlug($slug);

        $article['content'] = ArticleData::markdownToHtml($article['content']);

        if (!$article) {
            throw $this->createNotFoundException('L\'article demandé n\'existe pas');
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
