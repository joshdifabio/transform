<?php
namespace SnowIO\Transform\Internal;

use function SnowIO\Transform\assertIterable;
use SnowIO\Transform\FluentTransformTrait;
use SnowIO\Transform\Kv;
use SnowIO\Transform\Transform;

final class ValuesWithKeysAppliedToIterator implements Transform
{
    use FluentTransformTrait;

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $kv) {
            if (!$kv instanceof Kv) {
                throw new \Exception;
            }
            yield $kv->getKey() => $kv->getValue();
        }
    }
}
