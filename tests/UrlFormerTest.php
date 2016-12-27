<?php

use Monk\Interfaces\UrlFormerInterface;
use Monk\MonkTrait;

class UrlFormerTest extends PHPUnit_Framework_TestCase
{
    use MonkTrait;


    public function testUrlFormer()
    {
        $former = new class implements UrlFormerInterface
        {
            public function getUrl(string $resource): string
            {
                return "http://sansaralab.com/{$resource}";
            }
        };

        $this
            ->getMonk()
            ->setUrlFormer($former)
            ->setResource('test.json')
            ->send()
            ->assert()
            ->statusCode(200);
    }
}
