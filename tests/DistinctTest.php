<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Distinct;

class DistinctTest extends TransformTest
{
    public function getTransforms()
    {
        yield Distinct::create();
        yield Distinct::withRepresentativeValueFn(function () {});
    }

    public function getTestDataForApplyTo()
    {
        yield [
            Distinct::create(),
            [1, 1, 2, 3, 4, 1, 2],
            [1, 2, 3, 4],
        ];

        yield [
            Distinct::withRepresentativeValueFn(function (int $n) {
                return $n % 2 ? 'odd' : 'even';
            }),
            [1, 1, 2, 3, 4, 1, 2],
            [1, 2],
        ];
    }
}
