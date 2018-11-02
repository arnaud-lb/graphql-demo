<?php

namespace App\GraphQL\Type;

use GraphQL\Language\AST\StringValueNode;

class DateTimeType
{
    public static function serialize(\DateTimeInterface $value): string
    {
        return $value->format(DATE_RFC3339);
    }
 
    /**
     * @param mixed $value
     */
    public static function parseValue($value): \DateTimeImmutable
    {
        return new \DateTimeImmutable($value);
    }
 
    public static function parseLiteral(StringValueNode $valueNode): \DateTimeImmutable
    {
        return new \DateTimeImmutable($valueNode->value);
    }
}
