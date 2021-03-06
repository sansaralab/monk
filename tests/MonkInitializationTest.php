<?php

use Monk\Monk;
use Monk\Monk\Config;
use Monk\MonkTrait;

class MonkInitializationTest extends PHPUnit_Framework_TestCase
{
    use MonkTrait;


    public function testInitialization()
    {
        $monk = Monk::factory();
        $this->assertInstanceOf(Monk::class, $monk);
    }


    public function testBuiltInMethodInitialization()
    {
        $monk = $this->getMonk();
        $this->assertInstanceOf(Monk::class, $monk);
    }


    public function testDefaultConfigInitialization()
    {
        $defaultConfig = Config::factory();
        $defaultConfig->addParam('test_param', 'test_value');
        $this->setMonkDefaultConfig($defaultConfig);

        $monk = $this->getMonk();
        $monkConfig = $monk->config();

        $this->assertSame($defaultConfig, $monkConfig, 'Config must be equal');
    }
}
