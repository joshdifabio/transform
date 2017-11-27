<?php
namespace Joshdifabio\Transform;

final class CoGroupByKey
{
    public static function create(): Transform
    {
        return self::swapKeys()
            ->then(GroupByKey::create())
            ->then(FlatMapValues::via([self::createCoGbkResult(), 'applyTo']));
    }

    private static function swapKeys(): Transform
    {
        return FlatMapElements::via(function (Kv $subCollection) {
            /** @var Kv $element */
            foreach ($subCollection->getValue() as $element) {
                yield Kv::of($element->getKey(), Kv::of($subCollection->getKey(), $element->getValue()));
            }
        });
    }

    private static function createCoGbkResult(): Transform
    {
        return GroupByKey::create()->then(new class implements Transform {
            use FluentTransformTrait;

            public function applyTo($input): \Iterator
            {
                $coGbkResult = CoGbkResult::empty();
                /** @var Kv $resultForSubCollection */
                foreach ($input as $resultForSubCollection) {
                    $coGbkResult = $coGbkResult->and($resultForSubCollection->getKey(), $resultForSubCollection->getValue());
                }
                yield $coGbkResult;
            }
        });
    }
}
