<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\MapElements;

class MapElementsTest extends TransformTest
{
    public function getTransforms()
    {
        yield MapElements::via(function (int $n): string {
            return $n % 2 == 0 ? 'even' : 'odd';
        });
    }

    public function getTestDataForApplyTo()
    {
        yield [
            MapElements::via(function (int $n): string {
                return $n % 2 == 0 ? 'even' : 'odd';
            }),
            [1, 2, 3, 4],
            ['odd', 'even', 'odd', 'even'],
        ];
    }
}
