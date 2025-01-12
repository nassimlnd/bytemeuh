<?php
// src/Data/ArticleData.php
namespace App\Data;

class ArticleData
{
    public static function getArticles(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Bienvenue sur ByteMeuh, le blog tech décalé',
                'slug' => 'bienvenue-sur-bytemeuh',
                'content' => 'Bienvenue sur ByteMeuh, votre nouvelle ferme numérique où la tech rencontre l’humour ! 🚀🐄 '
                    . 'Ici, nous parlons de code, de nouvelles technologies et d’astuces pour les développeurs, le tout avec une pointe d’autodérision. '
                    . 'Parce qu’on sait qu’après une journée à chasser des bugs, un peu de légèreté, c’est essentiel.'
                    . "\n\n"
                    . '### Pourquoi ByteMeuh ?'
                    . "\n\n"
                    . 'ByteMeuh, c’est la combinaison de notre amour pour la technologie et… les vaches (eh oui, pourquoi pas ?). '
                    . 'Derrière ce nom décalé se cache une volonté : rendre le contenu tech accessible et fun, pour tous, débutants comme experts.'
                    . "\n\n"
                    . '### Que trouverez-vous ici ?'
                    . "\n\n"
                    . '- Des guides pratiques sur les langages de programmation populaires.'
                    . "\n"
                    . '- Des articles inspirants sur la culture tech.'
                    . "\n"
                    . '- Des analyses sur les tendances actuelles et futures du monde numérique.'
                    . "\n"
                    . '- Une bonne dose de vannes et de fun, parce qu’on ne va pas se mentir : coder, c’est cool, mais rire, c’est mieux.'
                    . "\n\n"
                    . '### Rejoignez-nous !'
                    . "\n\n"
                    . 'Abonnez-vous à ByteMeuh et préparez-vous à découvrir des articles qui vont nourrir votre cerveau… et chatouiller vos zygomatiques !',
                'createdAt' => '2025-01-12',
            ],
            [
                'id' => 2,
                'title' => 'Les meilleures astuces pour coder comme une vache 🐮',
                'slug' => 'astuces-pour-coder-comme-une-vache',
                'content' => 'Coder, c’est un art. Mais coder comme une vache ? Ça, c’est un style de vie. 🐮'
                    . "\n\n"
                    . 'Dans cet article, nous vous partageons des astuces pour développer votre propre style de code, tout en restant efficace et organisé.'
                    . "\n\n"
                    . ''
                    . "\n\n"
                    . '### 1. Prenez le temps de ruminer vos idées'
                    . "\n\n"
                    . 'Avant de foncer sur votre clavier, réfléchissez à votre approche. Posez-vous ces questions :'
                    . "\n"
                    . '- Quel est l’objectif de votre code ?'
                    . "\n"
                    . '- Y a-t-il une solution plus simple que celle que vous envisagez ?'
                    . "\n"
                    . '- Comment votre code peut-il rester compréhensible pour une autre personne (ou pour vous-même dans 6 mois) ?'
                    . "\n\n"
                    . '### 2. Adoptez une méthode itérative'
                    . "\n\n"
                    . 'Les vaches ne construisent pas une grange en une nuit. Vous non plus, ne cherchez pas à écrire tout votre code d’un seul coup. Avancez petit à petit :'
                    . "\n"
                    . '- Développez des fonctionnalités simples et testez-les immédiatement.'
                    . "\n"
                    . '- Faites des ajustements en fonction des retours (ou des bugs rencontrés).'
                    . "\n"
                    . '- Célébrez chaque petite victoire avec un bon lait chocolaté.'
                    . "\n\n"
                    . '### 3. Ne négligez pas l’aspect collaboratif'
                    . "\n\n"
                    . 'Même une vache solitaire finit par rejoindre le troupeau. Partagez votre code avec d’autres, discutez de vos choix techniques et apprenez de vos pairs.'
                    . "\n\n"
                    . ''
                    . "\n\n"
                    . 'En suivant ces conseils, vous serez bientôt prêt à coder comme une vache : lentement, mais sûrement, et toujours avec style.',
                'createdAt' => '2025-01-10',
            ],
            [
                'id' => 3,
                'title' => 'Pourquoi ByteMeuh est la ferme ultime pour devs',
                'slug' => 'bytemeuh-ferme-ultime-pour-devs',
                'content' => 'ByteMeuh n’est pas qu’un simple blog, c’est une philosophie. Ici, chaque développeur, du junior au senior, est traité comme une star… bovine. 🐄'
                    . "\n\n"
                    . ''
                    . "\n\n"
                    . '### Ce qui rend ByteMeuh unique'
                    . "\n\n"
                    . '1. **Des contenus de qualité** : Nous ne publions que des articles utiles, rédigés par des experts qui ont vécu les galères de debugging jusqu’à 2h du matin.'
                    . "\n"
                    . '2. **L’humour avant tout** : Parce que lire des tutoriels techniques ne devrait jamais être ennuyeux.'
                    . "\n"
                    . '3. **Une communauté bienveillante** : Chez ByteMeuh, pas de jugement. Que vous soyez un pro de Symfony ou que vous débutiez avec HTML, vous êtes le bienvenu.'
                    . "\n\n"
                    . '### Les sujets qui vous passionnent'
                    . "\n\n"
                    . '- Des tutoriels détaillés sur des frameworks populaires (comme Symfony et React).'
                    . "\n"
                    . '- Des astuces pour booster votre productivité.'
                    . "\n"
                    . '- Des analyses sur l’avenir des métiers tech (IA, blockchain, et plus encore).'
                    . "\n"
                    . '- Des blagues, des memes, et des moments légers, parce que coder sans rire, c’est tricher.'
                    . "\n\n"
                    . ''
                    . "\n\n"
                    . 'Alors, prêt à rejoindre ByteMeuh et à faire partie de la ferme tech la plus cool de l’univers ? Cliquez sur le bouton d’inscription et venez brouter les meilleures infos tech avec nous.',
                'createdAt' => '2025-01-08',
            ],
        ];
    }

    public static function getArticleBySlug(string $slug): ?array
    {
        $articles = self::getArticles();
        foreach ($articles as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        return null; // Article non trouvé
    }

    public static function markdownToHtml(string $markdown): string
    {
        // Convertir les titres
        $markdown = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $markdown); // Titres de niveau 3
        $markdown = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $markdown); // Titres de niveau 2
        $markdown = preg_replace('/^# (.+)$/m', '<h1>$1</h1>', $markdown); // Titres de niveau 1

        // Convertir le texte en gras
        $markdown = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $markdown);

        // Convertir le texte en italique
        $markdown = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $markdown);

        // Convertir les listes non ordonnées
        $markdown = preg_replace('/^- (.+)$/m', '<li>$1</li>', $markdown);
        $markdown = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', $markdown);

        // Convertir les sauts de ligne en <br> pour les paragraphes simples
        $markdown = nl2br($markdown);

        // Convertir les --- ou *** en <hr>
        $markdown = preg_replace('/^(-{3,}|\\*{3,})$/m', '<hr>', $markdown);

        // Convertir les séparateurs (--- ou *** en <hr>)
        $markdown = preg_replace('/^(-{3,}|\\*{3,})$/m', '<hr>', $markdown);

        return $markdown;
    }
}
