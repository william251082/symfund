<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function (Article $article, $count) {
            $article->setTitle('Why asteroids')
                ->setSlug('why-asteroids-taste-like-bacon-'. $count)
                ->setContent(<<<EOF
Bacon ipsum dolor amet venison **landjaeger** ham hock, corned beef [pork chop](https://baconipsum.com/?paras=5&type=all-meat&start-with-lorem=1) rump **doner**. Frankfurter **brisket** pastrami tenderloin sirloin alcatra. Cupim tongue jerky pancetta. Tri-tip flank frankfurter ham hock pork chop, cupim shoulder landjaeger ball tip kielbasa corned beef pastrami burgdoggen. Pork belly tail frankfurter pancetta landjaeger salami beef ribs picanha. Meatloaf ham beef shankle burgdoggen flank, ribeye alcatra pork doner.
EOF
                );

            // publish most articles
            if (rand(1, 10) > 2) {
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }

            $article->setAuthor('Mike Ferengi')
                ->setHeartCount(rand(5, 100))
                ->setImageFilename('asteroid.jpeg');
        });


        $manager->flush();
    }
}
