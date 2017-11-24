<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Filter;

class FilterTest extends TransformTest
{
    public function getTransforms()
    {
        yield Filter::by(function (int $n) { return $n % 2 == 0; });
    }

    public function getTestDataForApplyTo()
    {
        yield [
            Filter::by(function (int $n) { return $n % 2 == 0; }),
            [1, 2, 3, 4, 5, 6],
            [2, 4, 6],
        ];

        yield [
            Filter::equalTo(3),
            [1, null, 2, 3, null, null, 4, 5, 6, null],
            [3],
        ];

        yield [
            Filter::notEqualTo(3),
            [1, null, 2, 3, null, null, 4, 5, 6, null],
            [1, null, 2, null, null, 4, 5, 6, null]
        ];
    }
}
