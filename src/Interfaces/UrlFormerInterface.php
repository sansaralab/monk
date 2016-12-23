<?php

namespace Monk\Interfaces;

/**
 * For making full url from only uri.
 *
 * Interface UrlFormerInterface
 * @package Monk\Interfaces
 */
interface UrlFormerInterface
{


    public function getUrl(string $resource): string;
}
