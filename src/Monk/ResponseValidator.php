<?php

namespace Monk\Monk;

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;
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


    protected function getErrorMessage(string $message): string
    {
        return $message;
    }


    /**
     * @param int $code
     * @param string $errorMessage
     * @return $this
     */
    public function statusCode(int $code, string $errorMessage = '')
    {
        PHPUnit_Framework_Assert::assertEquals(
            $code,
            $this->getResponse()->getResponse()->getStatusCode(),
            $this->getErrorMessage($errorMessage)
        );

        return $this;
    }


    /**
     * @param string $path
     * @param $expectedValue
     * @param string $errorMessage
     * @return $this
     */
    public function jsonPointer(string $path, $expectedValue, $errorMessage = '')
    {
        $data = json_decode($this->getResponse()->getResponse()->getBody());
        $reader = new Selector($data);
        $readPointer = new Pointer($reader);
        $actualValue = $readPointer->read($path)->getAsStruct();

        PHPUnit_Framework_Assert::assertEquals(
            $expectedValue,
            $actualValue,
            $this->getErrorMessage($errorMessage)
        );

        return $this;
    }


    /**
     * @param string $expectedKey
     * @param string $errorMessage
     * @return $this
     */
    public function hasHeader(string $expectedKey, string $errorMessage = '')
    {
        $has = $this
            ->getResponse()
            ->getResponse()
            ->hasHeader($expectedKey);

        PHPUnit_Framework_Assert::assertTrue($has, $this->getErrorMessage($errorMessage));

        return $this;
    }


    /**
     * @param string $expectedKey
     * @param string[] $expectedValues
     * @param string $errorMessage
     * @return $this
     */
    public function header(string $expectedKey, array $expectedValues, string $errorMessage = '')
    {
        $has = $this
            ->getResponse()
            ->getResponse()
            ->hasHeader($expectedKey);

        PHPUnit_Framework_Assert::assertTrue($has, $this->getErrorMessage($errorMessage));

        $headers = $this
            ->getResponse()
            ->getResponse()
            ->getHeader($expectedKey);

        PHPUnit_Framework_Assert::assertEquals($expectedValues, $headers, $this->getErrorMessage($errorMessage));

        return $this;
    }


    /**
     * @param string $schema
     * @param string $errorMessage
     * @return $this
     */
    public function jsonSchema(string $schema, string $errorMessage = '')
    {
        $body = (string) $this->getResponse()->getResponse()->getBody();
        $data = json_decode($body);

        $jsonSchemaObject = json_decode($schema);
        $schemaStorage = new SchemaStorage();
        $schemaStorage->addSchema('file://schema', $jsonSchemaObject);

        $validator = new Validator(new Factory($schemaStorage));
        $validator->check($data, $jsonSchemaObject);

        PHPUnit_Framework_Assert::assertTrue($validator->isValid(), $errorMessage);

        return $this;
    }
}
