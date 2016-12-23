<?php

namespace Monk\Monk;

use Monk\Base\Factory;

class Response extends Factory
{


    public function assertStatusCode(int $code)
    {
        return $this;
    }


    public function assertJsonSchema(string $schemaName)
    {
        return $this;
    }
}
