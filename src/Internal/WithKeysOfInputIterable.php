<?php
namespace Josh\Functional\Internal;

use function Josh\Functional\assertIterable;
use Josh\Functional\Kv;
use Josh\Functional\SingularTransformTrait;
use Josh\Functional\Transform;

final class WithKeysOfInputIterable implements Transform
{
    use SingularTransformTrait;

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $key => $value) {
            yield Kv::of($key, $value);
        }
    }
}
