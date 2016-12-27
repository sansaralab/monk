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


    public function testRequestNotFoundCode()
    {
        $this
            ->getMonk()
            ->setResource('sansaralab.com/some_path_that_not_exists')
            ->send()
            ->assert()
            ->statusCode(404, 'Resource should not be found');
    }


    public function testHasHeader()
    {
        $this
            ->getMonk()
            ->setResource('sansaralab.com')
            ->send()
            ->assert()
            ->hasHeader('Content-Type');
    }


    public function testHeader()
    {
        $this
            ->getMonk()
            ->setResource('sansaralab.com')
            ->send()
            ->assert()
            ->headers('Content-Type', ['text/html; charset=utf-8']);
    }
}
