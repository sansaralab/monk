<?php

namespace Monk\DTO;

class Auth
{

    protected $login = null;

    protected $password = null;


    /**
     * @return null|string
     */
    public function getLogin()
    {
        return $this->login;
    }


    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }


    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
}
