<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Kv;
use SnowIO\Transform\MapValues;

class MapValuesTest extends TransformTest
{
    public function getTransforms()
    {
        yield MapValues::via(function () {});
    }

    public function getTestDataForApplyTo()
    {
        yield [
            MapValues::via(function (int $n): string {
                return $n % 2 == 0 ? 'even' : 'odd';
            }),
            [Kv::of('one', 1), Kv::of('two', 2), Kv::of('three', 3), Kv::of('four', 4)],
            [Kv::of('one', 'odd'), Kv::of('two', 'even'), Kv::of('three', 'odd'), Kv::of('four', 'even')],
        ];

        yield [
            MapValues::via(function (int $n): string {
                return $n % 2 == 0 ? 'even' : 'odd';
            }),
            [1, 2, 3, 4],
            ExpectError::ofType(\TypeError::class),
        ];
    }
}
