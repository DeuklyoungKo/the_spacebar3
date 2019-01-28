<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


class TestController extends AbstractController
{

    use TargetPathTrait;

    /**
     * @Route("/test", name="test")
     */
    public function test(Request $request)
    {

//        $result = getenv('APP_ENV')


        dd();




        $session = $request->getSession();

        dump($session);

        $target = $this->getTargetPath($request->getSession(),'main');
        dd($target);

    }

    /**
     * @Route("/test/UserPassword", name="test_UserPassword")
     */
    public function testUserPassword(UserPasswordEncoderInterface $encoder)
    {
        $user  = new User();

        $user->setPassword($encoder->encodePassword(
            $user,
            '1111'
        ));

        $return = $encoder->isPasswordValid($user, '1111');

        dd($return);
    }
}
