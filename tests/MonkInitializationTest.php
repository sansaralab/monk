<?php

use Monk\Monk;
use Monk\TestCase;

class MonkInitializationTest extends TestCase
{


    public function testInitialization()
    {
        $monk = Monk::factory();
        $this->assertInstanceOf('Monk\Monk', $monk);
    }


    public function testBuiltInMethodInitialization()
    {
        $monk = $this->monk();
        $this->assertInstanceOf('Monk\Monk', $monk);
    }
}
