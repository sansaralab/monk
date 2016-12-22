<?php

namespace Monk;

use Monk\Base\Factory;
use Monk\Monk\Config;

class Monk extends Factory
{

    /**
     * @var string Request url.
     */
    protected $url = null;

    /**
     * @var null Request method.
     */
    protected $method = null;

    /**
     * @var Config Monk config.
     */
    protected $config = null;


    protected function __construct()
    {
        $this->config = new Config();
    }


    public static function test()
    {
        return static::factory();
    }


    public function config(): Config
    {
        return $this->config;
    }


    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }


    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }


    public function send()
    {
        return $this;
    }


    public function assertStatusCode(int $code)
    {
        return $this;
    }


    public function assertJsonSchema(string $schemaName)
    {
        return $this;
    }
}
