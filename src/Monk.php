<?php

namespace Monk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Monk\Base\DefaultUrlFormer;
use Monk\Base\Factory;
use Monk\Interfaces\UrlFormerInterface;
use Monk\Monk\Config;
use Monk\Monk\Response;

class Monk extends Factory
{

    /**
     * @var string Request url.
     */
    protected $resource = null;

    /**
     * @var null Request method.
     */
    protected $method = null;

    /**
     * @var Config Monk config.
     */
    protected $config = null;

    /**
     * @var UrlFormerInterface
     */
    protected $urlFormer = null;

    /**
     * @var string[]
     */
    protected $headers = [];


    protected function __construct()
    {
        $this->config = new Config();
        $this->urlFormer = new DefaultUrlFormer();
    }


    /**
     * @return static
     */
    public static function test()
    {
        return static::factory();
    }


    /**
     * @return Config
     */
    public function config(): Config
    {
        return $this->config;
    }


    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }


    /**
     * @param string $resource
     * @return $this
     */
    public function setResource(string $resource)
    {
        $this->resource = $resource;
        return $this;
    }


    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }


    public function setUrlFormer(UrlFormerInterface $former)
    {
        $this->urlFormer = $former;
        return $this;
    }


    /**
     * @return Response
     */
    public function send(): Response
    {
        $this->assertPredefined();

        $url = $this->urlFormer->getUrl($this->resource);

        // Setting default headers.
        $defaultHeaders = $this->config()->getHeaders();
        $headers = array_merge($defaultHeaders, $this->headers);

        $request = new Request(
            $this->method,
            $url,
            $headers
        );

        $client = new Client();
        $client->send($request);
        $response = $client->request(
            $this->method,
            $this->resource,
            []
        );
        return Response::factory();
    }


    protected function assertPredefined()
    {
        if (is_null($this->method)) {
            throw new \Exception('Request method must be set');
        }
        if (is_null($this->resource)) {
            throw new \Exception('Request resource must be set');
        }
        if (is_null($this->urlFormer)) {
            throw new \Exception('Url former must be set');
        }
    }
}
