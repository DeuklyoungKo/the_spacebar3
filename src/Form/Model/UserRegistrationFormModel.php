<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-02-04
 * Time: 오전 7:39
 */

namespace App\Form\Model;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(
 *     fields={"email"},
 *     message="I think you're already registered!"
 * )
 */
class UserRegistrationFormModel
{

    /**
     * @Assert\NotBlank(message="Please enteran email")
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotBlank(message="Choose a password!")
     * @Assert\Length(min=5, minMessage="Come on, you can think of a password longer than that!")
     */
    public $plainPassword;

    /**
     * @Assert\IsTrue(message="I know, it's silly, but you must agree to our terms.")
     */
    public $agreeTerms;
}