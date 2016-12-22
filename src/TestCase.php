<?php

namespace Monk;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{


    public function monk(): Monk
    {
        return Monk::factory();
    }
}
