<?php

namespace App\Command;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsCommand('app:create:articles')]
final class CreateArticlesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SluggerInterface $slugger
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->getArticles() as $article) {
            $slug = $this->slugger->slug($article['title'])->lower();
            $article['slug'] = $slug;

            $this->entityManager->persist((new Article())
                ->setTitle($article['title'])
                ->setSlug($article['slug'])
                ->setContent($article['content'])
            );
        }

        $this->entityManager->flush();

        return Command::SUCCESS;
    }

    private function getArticles(): array
    {
        return [
            [
                'title' => 'Hello World',
                'content' => 'This is the first article',
            ],
        ];
    }
}
