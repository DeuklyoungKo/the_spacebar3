<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(UserPasswordEncoderInterface $encoder)
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
