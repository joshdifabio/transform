<?php
namespace SnowIO\Transform;

use SnowIO\Transform\Internal\ValuesWithKeysAppliedToIterator;

final class Values
{
    public static function get(): Transform
    {
        return MapElements::via(Kv::value());
    }

    public static function withKeysAppliedToIterator(): Transform
    {
        return new ValuesWithKeysAppliedToIterator();
    }
}
