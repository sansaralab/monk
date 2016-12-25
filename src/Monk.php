<?php

namespace Monk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Monk\Base\DefaultUrlFormer;
use Monk\Base\Factory;
use Monk\Interfaces\UrlFormerInterface;
use Monk\Monk\Config;
use Monk\Monk\Method;
use Monk\Monk\Response;

/**
 * Class Monk
 * @package Monk
 */
class Monk extends Factory
{

    /**
     * @var string Request url.
     */
    protected $resource = null;

    /**
     * @var null Request method.
     */
    protected $method = Method::GET;

    /**
     * @var Config Monk config.
     */
    protected $config = null;

    /**
     * @var UrlFormerInterface
     */
    protected $urlFormer = null;


    /**
     * Monk constructor.
     */
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


    /**
     * @param Config $config
     * @return $this
     */
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


    /**
     * @param UrlFormerInterface $former
     * @return $this
     */
    public function setUrlFormer(UrlFormerInterface $former)
    {
        $this->urlFormer = $former;
        return $this;
    }


    /**
     * @return Response
     * @throws \Exception
     */
    public function send(): Response
    {
        $this->assertPredefined();

        $url = $this->urlFormer->getUrl($this->resource);

        $headers = $this->config()->getHeaders();

        $request = new Request(
            $this->method,
            $url,
            $headers
        );

        $paramsData = $this->config()->getParams();
        $requestParameters = [];

        if (in_array($this->method, [Method::POST, Method::PUT, Method::DELETE])) {
            if ($this->config()->getParamsType() === Config::PARAMS_FORM) {
                $requestParameters['form_params'] = $paramsData;
            } elseif ($this->config()->getParamsType() === Config::PARAMS_BODY) {
                $requestParameters['body'] = json_encode($paramsData);
            } else {
                throw new \Exception("Wrong request params type: '{$this->config()->getParamsType()}'");
            }
        }

        $client = new Client();
        $client->send($request);
        $response = $client->request(
            $this->method,
            $this->resource,
            []
        );
        return Response::factory()->setResponse($response);
    }


    /**
     * @throws \Exception
     */
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
