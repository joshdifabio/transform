<?php
namespace Joshdifabio\Transform\Internal;

use function Joshdifabio\Transform\assertIterable;
use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\FluentTransformTrait;
use Joshdifabio\Transform\Transform;

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
