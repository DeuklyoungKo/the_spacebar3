<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-06
 * Time: 오후 12:04
 */

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;

use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;

use KnpU\LoremIpsumBundle\KnpUIpsum;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use TestBundle\Test;

class ArticleController extends AbstractController
{
    /**
     * @var
     */
    private $isDebug;
    /**
     * @var KnpUIpsum
     */
    private $knpUIpsum;
    /**
     * @var Test
     */
    private $test;

    public function __construct(bool $isDebug, KnpUIpsum $knpUIpsum, Test $test)
    {
        $this->isDebug = $isDebug;
        $this->knpUIpsum = $knpUIpsum;
        $this->test = $test;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {

        $articles = $repository->findAllPublishedOrderedByNewset();

        return $this->render('article/homepage.html.twig',[
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart",methods={"POST"})
     */
    public function togglearticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {

        $article->incrementHeartCount();
        $em->flush();

        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(Article $article, SlackClient $slack, MarkdownHelper $markdownHelper)
    {

        if($article->getSlug() === 'khaaaaaan'){
            $slack->sendMessage('kahn','Ah, Kirk, my old friend ...1');
        }


        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $articleContent = $this->knpUIpsum->getParagraphs();

        $articleContent = $markdownHelper->parse($articleContent);

        $articleContent .= sprintf('<br>countString = %s', $this->test->countString($articleContent));

        return $this->render('article/show.html.twig',[
            'article' => $article,
            'comments' => $comments,
            'articleContent' => $articleContent,
        ]);

    }


}