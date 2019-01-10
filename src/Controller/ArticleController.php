<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-06
 * Time: 오후 12:04
 */

namespace App\Controller;

use App\Entity\Article;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @var
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em)
    {

        $repository = $em->getRepository(Article::class);
        $articles = $repository->findBy([],['publishedAt' => 'DESC']);



        return $this->render('article/homepage.html.twig',[
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart",methods={"POST"})
     */
    public function togglearticleHeart($slug, LoggerInterface $logger)
    {

        $logger->info('Article is being hearted!');
        return new JsonResponse(['hearts' => rand(5,100)]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, SlackClient $slack, EntityManagerInterface $em)
    {
        if($slug === 'khaaaaaan'){
            $slack->sendMessage('kahn','Ah, Kirk, my old friend ...1');
        }


        $repository = $em->getRepository(Article::class);

        $article = $repository->findOneBy(['slug' => $slug]);

        if(!$article){
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }


        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];


        return $this->render('article/show.html.twig',[
            'article' => $article,
            'comments' => $comments,
        ]);

    }
}