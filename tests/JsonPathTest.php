<?php

use Monk\MonkTrait;

class JsonPathTest extends PHPUnit_Framework_TestCase
{
    use MonkTrait;


    public function testSimplePath()
    {
        $this
            ->getMonk()
            ->setResource('sansaralab.com/test.json')
            ->send()
            ->assert()
            ->statusCode(200, 'Wrong status code')
            ->jsonPointer('/b/c', 2, 'Wrong value in json');
    }
}
