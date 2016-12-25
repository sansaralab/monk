<?php

use Monk\MonkTrait;

class RequestTest extends PHPUnit_Framework_TestCase
{
    use MonkTrait;


    public function testRequestSuccessCode()
    {
        $this
            ->getMonk()
            ->setResource('sansaralab.com')
            ->send()
            ->assert()
            ->statusCode(200, 'Wrong status code');
    }
}
