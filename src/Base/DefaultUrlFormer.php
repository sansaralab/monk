<?php

namespace Monk\Base;

use Monk\Interfaces\UrlFormerInterface;

class DefaultUrlFormer implements UrlFormerInterface
{


    public function getUrl(string $resource): string
    {
        return $resource;
    }
}
