<?php
namespace Joshdifabio\Transform;

final class FlatMapValues
{
    public static function via(callable $fn): Transform
    {
        return FlatMapElements::via(function (Kv $element) use ($fn) {
            foreach ($fn($element->getValue()) as $outputValue) {
                yield Kv::of($element->getKey(), $outputValue);
            }
        });
    }

    public static function viaTransform(Transform $transform): Transform
    {
        return FlatMapValues::via([$transform, 'applyTo']);
    }
}
