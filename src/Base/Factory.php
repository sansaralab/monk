<?php

namespace Monk\Base;

class Factory
{


    protected function __construct()
    {
    }


    public static function factory()
    {
        return new static();
    }
}
