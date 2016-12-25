<?php

namespace Monk\Monk;

use PHPUnit_Framework_Assert;
use Remorhaz\JSON\Data\Reference\Selector;
use Remorhaz\JSON\Pointer\Pointer;

/**
 * Class ResponseValidator
 * @package Monk\Monk
 */
class ResponseValidator
{

    /**
     * @var Response
     */
    protected $response = null;


    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    /**
     * @return Response
     */
    protected function getResponse(): Response
    {
        return $this->response;
    }


    /**
     * @param int $code
     * @param string $errorMessage
     * @return $this
     */
    public function statusCode(int $code, string $errorMessage)
    {
        PHPUnit_Framework_Assert::assertEquals(
            $code,
            $this->getResponse()->getResponse()->getStatusCode(),
            $errorMessage
        );

        return $this;
    }


    /**
     * @param string $path
     * @param $expectedValue
     * @return $this
     */
    public function jsonPointer(string $path, $expectedValue, $errorMessage)
    {
        $data = json_decode($this->getResponse()->getResponse()->getBody());
        $reader = new Selector($data);
        $readPointer = new Pointer($reader);
        $actualValue = $readPointer->read($path)->getAsStruct();
        PHPUnit_Framework_Assert::assertEquals($expectedValue, $actualValue, $errorMessage);

        return $this;
    }


    /**
     * TODO
     * @param string $expectedKey
     * @param string $errorMessage
     * @return $this
     */
    public function hasHeader(string $expectedKey, string $errorMessage)
    {
        return $this;
    }


    /**
     * TODO
     * @param string $expectedKey
     * @param string $expectedValue
     * @param string $errorMessage
     * @return $this
     */
    public function header(string $expectedKey, string $expectedValue, string $errorMessage)
    {
        return $this;
    }


    /**
     * TODO
     * @param string $schema
     * @param string $errorMessage
     * @return $this
     */
    public function jsonSchema(string $schema, string $errorMessage)
    {
        return $this;
    }
}
