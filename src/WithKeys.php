<?php
namespace Joshdifabio\Transform;

use Joshdifabio\Transform\Internal\WithKeysOfInputIterable;

final class WithKeys
{
    public static function of(callable $fn): Transform
    {
        return MapElements::via(function ($value) use ($fn) {
            $key = $fn($value);
            return Kv::of($key, $value);
        });
    }

    public static function ofInputIterable(): Transform
    {
        return new WithKeysOfInputIterable;
    }
}
