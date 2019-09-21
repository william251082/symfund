<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture
{
    private static $articleTitles = [
        'Why asteroids',
        'Life on a Planet',
        'Light Speed',
    ];

    private static $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];

    private static $articleAuthors = [
        'Mike Ferengi',
        'John Doe',
        'Rob Smith',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function (Article $article) {
            $article->setTitle($this->faker->randomElement(self::$articleTitles))
                ->setSlug($this->faker->slug)
                ->setContent(<<<EOF
Bacon ipsum dolor amet venison **landjaeger** ham hock, corned beef [pork chop](https://baconipsum.com/?paras=5&type=all-meat&start-with-lorem=1) rump **doner**. Frankfurter **brisket** pastrami tenderloin sirloin alcatra. Cupim tongue jerky pancetta. Tri-tip flank frankfurter ham hock pork chop, cupim shoulder landjaeger ball tip kielbasa corned beef pastrami burgdoggen. Pork belly tail frankfurter pancetta landjaeger salami beef ribs picanha. Meatloaf ham beef shankle burgdoggen flank, ribeye alcatra pork doner.
EOF
                );

            // publish most articles
            if ($this->faker->boolean(70)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }

            $article->setAuthor($this->faker->randomElement(self::$articleAuthors))
                ->setHeartCount($this->faker->numberBetween(5, 100))
                ->setImageFilename($this->faker->randomElement(self::$articleImages));
        });

        $manager->flush();
    }
}
