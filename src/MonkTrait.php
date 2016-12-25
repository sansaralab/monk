<?php

namespace Monk;

use Monk\Monk\Config;

trait MonkTrait
{

    /**
     * @var Config
     */
    private $monkDefaultConfig = null;


    public function getMonk(): Monk
    {
        $monk = Monk::factory();
        $monk->setConfig($this->monkDefaultConfig ?? Config::factory());
        return $monk;
    }


    public function setMonkDefaultConfig(Config $config)
    {
        $this->monkDefaultConfig = $config;
    }
}
