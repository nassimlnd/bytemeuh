<?php

namespace App\Command;

use App\Data\ArticleData;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

#[AsCommand(
    name: 'app:generate-sitemap',
    description: 'Generate a sitemap',
)]
final class GenerateSitemapCommand extends Command
{
    public function __construct(private RouterInterface $router, private string $projectDir)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Generating sitemap file');

        $filePath = $this->projectDir.'/public/sitemap.xml';
        $dateNow = (new \DateTime())->format('Y-m-d');
        $encoder = new XmlEncoder();
        $context = [
            'xml_root_node_name' => 'urlset',
            'xml_version' => '1.0',
            'xml_encoding' => 'UTF-8',
            'xml_format_output' => true,
        ];
        $routerContext = $this->router->getContext();
        $routerContext->setScheme('https');
        $routerContext->setHost('sruuua.fr');
        $baseUri = $routerContext->getScheme().'://'.$routerContext->getHost();

        $routes = array_filter($this->router->getRouteCollection()->all(), function ($name) {
            return str_starts_with($name, 'app_');
        }, ARRAY_FILTER_USE_KEY);

        foreach ($routes as $name => $route) {
            if ('app_article_show' !== $name) {
                $route = $this->router->generate($name, [], UrlGeneratorInterface::ABSOLUTE_URL);
                $data[] = $this->formatXmlRoute($route, $dateNow, 1);
            } else {
                $articlesData = $this->getArticlesData($dateNow);
                $data = array_merge($data, $articlesData);
            }
        }

        usort($data, function ($a, $b) {
            return strcmp($a['loc'], $b['loc']);
        });

        $xmlData = $encoder->encode([
            '@xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
            'url' => $data,
        ], 'xml', $context);

        try {
            $xml = (new \SimpleXMLElement($xmlData))->asXml($filePath);
            $io->success(sprintf('Generated sitemap file at %s with lastmod %s', $filePath, $dateNow));
        } catch (\Exception $e) {
            $io->warning(sprintf('Error : %s', $e));

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    private function getArticlesData(string $dateNow): array
    {
        $articles = ArticleData::getArticles();
        $urls = [];
        foreach ($articles as $article) {
            $route = $this->router->generate('app_article_show', [
                'slug' => $article['slug'],
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $urls[] = $this->formatXmlRoute($route, $dateNow, 0.5);
        }

        return $urls;
    }

    private function formatXmlRoute(string $route, string $dateNow, float $priority): array
    {
        return [
            'loc' => $route,
            'lastmod' => $dateNow,
            'changefreq' => 'daily',
            'priority' => $priority,
        ];
    }
}
