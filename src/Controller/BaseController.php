<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-27
 * Time: 오후 6:05
 */

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{

    protected function getUser(): User
    {
        return parent::getUser();
    }
}