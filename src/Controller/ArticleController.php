<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-06
 * Time: 오후 12:04
 */

namespace App\Controller;




use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("OMG! My first page already! WOO!");
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response(sprintf('"Future page to show one space article: "%s"',$slug));
    }
}