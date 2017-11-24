<?php
namespace Joshdifabio\Transform;

final class MapValues
{
    public static function via(callable $fn): Transform
    {
        return MapElements::via(function (Kv $element) use ($fn) {
            return Kv::of($element->getKey(), $fn($element->getValue()));
        });
    }
}
