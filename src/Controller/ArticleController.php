<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-06
 * Time: 오후 12:04
 */

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
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
    public function show($slug, Environment $twigEnvironment)
    {

//        dump($slug, $this);

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];


//        return new Response(sprintf('"Future page to show one space article: "%s"',$slug));
//        return $this->render('article/show.html.twig',[
        $html = $twigEnvironment->render('article/show.html.twig',[
            'title' => ucwords(str_replace('-', ' ',$slug)),
            'comments' => $comments,
            'slug' => $slug,
        ]);

        return new Response($html);
    }
}