<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $manager)
    {
        $article = new Article();
        $article->setTitle('Why asteroids')
        ->setSlug('why-asteroids-taste-like-bacon-'.rand(100, 999))
        ->setContent(<<<EOF
Bacon ipsum dolor amet venison **landjaeger** ham hock, corned beef [pork chop](https://baconipsum.com/?paras=5&type=all-meat&start-with-lorem=1) rump **doner**. Frankfurter **brisket** pastrami tenderloin sirloin alcatra. Cupim tongue jerky pancetta. Tri-tip flank frankfurter ham hock pork chop, cupim shoulder landjaeger ball tip kielbasa corned beef pastrami burgdoggen. Pork belly tail frankfurter pancetta landjaeger salami beef ribs picanha. Meatloaf ham beef shankle burgdoggen flank, ribeye alcatra pork doner.
EOF
        );

        // publish most articles
        if (rand(1, 10) > 2) {
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        }

        $manager->persist($article);
        $manager->flush();

        return new Response(sprintf(
            'Hi! New article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}