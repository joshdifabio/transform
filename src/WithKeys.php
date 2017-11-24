<?php
namespace Joshdifabio\Transform;

use Joshdifabio\Transform\Internal\WithKeysOfInputIterable;

class WithKeys
{
    public static function of(callable $fn): Transform
    {
        return MapElements::via(function ($value) use ($fn) {
            $key = $fn($value);
            return Kv::of($key, $value);
        });
    }

    public static function ofInputElement(): Transform
    {
        return MapElements::via(function ($value) {
            return Kv::of($value, $value);
        });
    }

    public static function ofInputIterable(): Transform
    {
        return new WithKeysOfInputIterable;
    }
}
