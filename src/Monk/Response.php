<?php

namespace Monk\Monk;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Monk\Base\Factory;

/**
 * Class Response
 * @package Monk\Monk
 */
class Response extends Factory
{

    /**
     * @var GuzzleResponse
     */
    protected $rawResponse = null;


    /**
     * @return GuzzleResponse
     */
    public function getResponse(): GuzzleResponse
    {
        return $this->rawResponse;
    }


    /**
     * @param GuzzleResponse $rawResponse
     * @return $this
     */
    public function setResponse(GuzzleResponse $rawResponse)
    {
        $this->rawResponse = $rawResponse;
        return $this;
    }


    /**
     * @return ResponseValidator
     */
    public function assert(): ResponseValidator
    {
        return new ResponseValidator($this);
    }
}
