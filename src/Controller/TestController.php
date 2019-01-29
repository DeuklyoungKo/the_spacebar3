<?php
namespace App\Controller;

require_once __DIR__.'/../../public/etc/jsonTest.php';

use App\Entity\ApiToken;
use App\Entity\User;
use App\publics\etc\jsonTest;
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
    public function test()
    {

        $user = $this->getUser();
        dump($user);
        $token = new ApiToken($user);
        dump($token);
        $result = $token->getUser();
        dd($result);

    }


    /**
     * @Route("/test/randumBytes", name="test_randomBytes")
     */
    public function testRandomBytes()
    {

        $result = random_bytes(60);
        dump($result);
        $result = bin2hex($result);
        dd($result);

    }


    /**
     * @Route("/test/json", name="test_json")
     */
    public function testJson(Request $request)
    {
        $ins1 = new jsonTest();
        dump($ins1);
        $result = json_encode($ins1);
        dd($result);

    }

    /**
     * @Route("/test/session", name="test_session")
     */
    public function testSession(Request $request)
    {
        $session = $request->getSession();

        dump($session);
        dump(json_encode($session));
        $target = $this->getTargetPath($request->getSession(),'main');
        dd($target);

        $result = $this->json($request);
        dump($result);
        $result = $request;
//        $result = getenv('APP_ENV')
//        $result = $this->getUser();

        dd($result);

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
