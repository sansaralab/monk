<?php

namespace Monk\Monk;

use Monk\DTO\Auth;

/**
 * Class Config
 * @package Monk\Monk
 */
class Config
{

    /**
     * @var string[]
     */
    protected $headerList = [];

    /**
     * @var array
     */
    protected $defaultParamList = [];

    /**
     * @var Auth
     */
    protected $auth = null;


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
    public function addDefaultParam(string $key, $value)
    {
        $this->defaultParamList[$key] = $value;
        return $this;
    }


    /**
     * @return array
     */
    public function getDefaultParams(): array
    {
        return $this->defaultParamList;
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
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth;
    }
}
