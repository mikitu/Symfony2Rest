<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 06:25
 */

namespace ApiLib\Interfaces;


interface UserInterface
{
    public function login($username, $password);
}