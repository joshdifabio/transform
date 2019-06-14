<?php
namespace SnowIO\Transform\Internal;

use function SnowIO\Transform\assertIterable;
use SnowIO\Transform\Kv;
use SnowIO\Transform\FluentTransformTrait;
use SnowIO\Transform\Transform;

final class WithKeysOfInputIterable implements Transform
{
    use FluentTransformTrait;

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $key => $value) {
            yield Kv::of($key, $value);
        }
    }
}
