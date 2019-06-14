<?php
namespace SnowIO\Transform;

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
}
