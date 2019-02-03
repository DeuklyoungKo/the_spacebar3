<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-28
 * Time: 오후 3:30
 */

namespace App\publics\etc;



class jsonTest
{
    public $param1 = '1234';
    private $param2 = '5678';

    public function getParam1(){
        return $this->param1;
    }
}