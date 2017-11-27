<?php
namespace Joshdifabio\Transform;

final class MapElements
{
    public static function via(callable $fn): Transform
    {
        return FlatMapElements::via(function ($element) use ($fn) {
            yield $fn($element);
        });
    }

    public static function viaMethod(string $methodName): Transform
    {
        return FlatMapElements::via(function ($element) use ($methodName) {
            yield $element->$methodName();
        });
    }
}
