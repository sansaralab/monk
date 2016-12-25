<?php

namespace Monk\Monk;

use Monk\Base\Factory;
use Monk\DTO\Auth;

/**
 * Class Config
 * @package Monk\Monk
 */
class Config extends Factory
{

    /**
     * Params will send as x-form-url-encoded.
     */
    const PARAMS_FORM = 0;

    /**
     * Params will send as json body.
     */
    const PARAMS_BODY = 1;

    /**
     * @var string[]
     */
    protected $headerList = [];

    /**
     * @var array
     */
    protected $paramList = [];

    /**
     * @var Auth
     */
    protected $auth = null;

    /**
     * @var int
     */
    protected $paramsType = self::PARAMS_FORM;


    /**
     * @param string $header
     * @return $this
     */
    public function addHeader(string $header)
    {
        if (!in_array($header, $this->headerList)) {
            $this->headerList[] = $header;
        }
        return $this;
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headerList;
    }


    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function addParam(string $key, $value)
    {
        $this->paramList[$key] = $value;
        return $this;
    }


    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->paramList;
    }


    /**
     * @param string $login
     * @param string $password
     * @return $this
     */
    public function addAuth(string $login, string $password)
    {
        $this->auth = new Auth($login, $password);
        return $this;
    }


    /**
     * @return Auth|null
     */
    public function getAuth()
    {
        return $this->auth;
    }


    /**
     * @param int $type
     * @return $this
     */
    public function setParamsType(int $type)
    {
        $this->paramsType = $type;
        return $this;
    }


    /**
     * @return int
     */
    public function getParamsType(): int
    {
        return $this->paramsType;
    }
}
