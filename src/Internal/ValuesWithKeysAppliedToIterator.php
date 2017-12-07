<?php
namespace Joshdifabio\Transform\Internal;

use function Joshdifabio\Transform\assertIterable;
use Joshdifabio\Transform\FluentTransformTrait;
use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\Transform;

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
