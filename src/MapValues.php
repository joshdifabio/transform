<?php
namespace SnowIO\Transform;

final class MapValues
{
    public static function via(callable $fn): Transform
    {
        return FlatMapElements::via(function (Kv $element) use ($fn) {
            yield Kv::of($element->getKey(), $fn($element->getValue()));
        });
    }
}
