<?php
namespace Josh\Functional;

final class Count implements Transform
{
    use SingularTransformTrait;

    public static function globally(): Transform
    {
        return new self;
    }

    public static function perKey(): Transform
    {
        return GroupByKey::create()->then(MapValues::via('\count'));
    }

    public static function perKeyWithHashFn(callable $hashFn): Transform
    {
        return GroupByKey::withKeyHashFn($hashFn)->then(MapValues::via('\count'));
    }

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        $count = 0;
        foreach ($input as $element) {
            $count++;
        }
        yield $count;
    }

    private function __construct()
    {

    }
}
