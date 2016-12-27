<?php

use Monk\DTO\Auth;

class DTOTest extends PHPUnit_Framework_TestCase
{


    public function testAuth()
    {
        $username = '123123';
        $password = 'qweqwe';

        $auth = new Auth($username, $password);

        PHPUnit_Framework_Assert::assertEquals($username, $auth->getLogin(), 'Username not equals');
        PHPUnit_Framework_Assert::assertEquals($password, $auth->getPassword(), 'Password not equals');
    }
}
