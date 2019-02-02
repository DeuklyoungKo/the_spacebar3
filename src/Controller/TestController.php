<?php
namespace App\Controller;

require_once __DIR__.'/../../public/etc/jsonTest.php';

use App\Entity\User;
use App\publics\etc\jsonTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TestController extends AbstractController
{

    use TargetPathTrait;

    /**
     * @Route("/test/{objName}", name="test")
     */
    public function test(ValidatorInterface $validator, string $objName)
    {

        $class = 'App\Controller\\'.$objName;
        $object = new $class();

        // ... do something to the $author object

        $errors = $validator->validate($object);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('The author is valid! Yes!');

        /*
        // https://stackoverflow.com/questions/4578335/creating-php-class-instance-with-a-string
        // http://php.net/manual/en/language.variables.variable.php
        $str = 'One';
        $class = 'Class'.$str;
        $object = new $class();
        When using namespaces, supply the fully qualified name:

        $class = '\Foo\Bar\MyClass';
        $instance = new $class();
        Other cool stuff you can do in php are:
        Variable variables:

        $personCount = 123;
        $varname = 'personCount';
        echo $$varname; // echo's 123
        And variable functions & methods.

        $func = 'my_function';
        $func('param1'); // calls my_function('param1');

        $method = 'doStuff';
        $object = new MyClass();
        $object->$method(); // calls the MyClass->doStuff() method.
        */

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


class Author
{
    public $name = 'gogogo';

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
    }
}

