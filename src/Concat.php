<?php
namespace SnowIO\Transform;

final class Concat
{
    public static function iterables(): Transform
    {
        return FlatMapElements::via(function ($iterable) {
            assertIterable($iterable);
            foreach ($iterable as $element) {
                yield $element;
            }
        });
    }
}
