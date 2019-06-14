<?php
namespace SnowIO\Transform;

final class Diff implements Transform
{
    use FluentTransformTrait;

    public static function create(): Transform
    {
        $diff = new self;
        $diff->fn = function ($element) {
            return (string)$element;
        };
        return $diff;
    }

    public static function withRepresentativeValue(callable $fn): Transform
    {
        $diff = new self;
        $diff->fn = $fn;
        return $diff;
    }

    public function applyTo($input): \Iterator
    {
        if (!\is_array($input)) {
            assertIterable($input);
            $input = \iterator_to_array($input, $useKeys = false);
        }

        $sizeOfInput = \count($input);

        if ($sizeOfInput == 0) {
            return new \EmptyIterator;
        }

        return WithKeys::ofInputIterable()
            ->then(MapValues::via(function ($collection) {
                assertIterable($collection);
                foreach ($collection as $element) {
                    $representativeValue = ($this->fn)($element);
                    yield Kv::of($representativeValue, $element);
                }
            }))
            ->then(CoGroupByKey::create())
            ->then(FlatMapValues::via(function (CoGbkResult $result) use ($sizeOfInput) {
                for ($collectionNo = 1; $collectionNo < $sizeOfInput; $collectionNo++) {
                    if ($result->getAll($collectionNo) !== []) {
                        return;
                    }
                }
                yield from $result->getAll(0);
            }))
            ->then(Values::get())
            ->applyTo($input);
    }

    private $fn;

    private function __construct()
    {

    }
}
