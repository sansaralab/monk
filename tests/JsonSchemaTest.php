<?php

use Monk\MonkTrait;

class JsonSchemaTest extends PHPUnit_Framework_TestCase
{
    use MonkTrait;


    public function testSchema()
    {
        $schema = <<<'EOL'
{
  "$schema": "http://json-schema.org/draft-04/schema#",
  "type": "object",
  "properties": {
    "a": {
      "type": "integer"
    },
    "b": {
      "type": "object",
      "properties": {
        "c": {
          "type": "integer"
        },
        "d": {
          "type": "integer"
        }
      },
      "required": [
        "c",
        "d"
      ]
    }
  },
  "required": [
    "a",
    "b"
  ]
}
EOL;

        $this
            ->getMonk()
            ->setResource('sansaralab.com/test.json')
            ->send()
            ->assert()
            ->statusCode(200)
            ->jsonSchema($schema);
    }
}
