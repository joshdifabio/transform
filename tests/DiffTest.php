<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Diff;

class DiffTest extends TransformTest
{
    public function getTransforms()
    {
        yield Diff::withRepresentativeValue(function () {});
    }

    public function getTestDataForApplyTo()
    {
        yield [
            Diff::withRepresentativeValue(function (int $n) {
                return $n % 2 ? 'odd' : 'even';
            }),
            [[1, 2], [9]],
            [2]
        ];

        yield [
            Diff::withRepresentativeValue(function (int $n) {
                return $n % 2 ? 'odd' : 'even';
            }),
            [[1, 2, 3, 4], [9]],
            [2, 4]
        ];

        yield [
            Diff::create(),
            [[1, 2], [9]],
            [1, 2]
        ];

        yield [
            Diff::create(),
            [[1, 2]],
            [1, 2]
        ];

        yield [
            Diff::create(),
            [[], [1, 2]],
            []
        ];

        yield [
            Diff::create(),
            [],
            []
        ];

        $gen = function ($step) {
            for ($i = 0; $i < 5 * $step; $i += $step) {
                yield $i;
            }
        };

        yield [
            Diff::create(),
            [$gen(2), $gen(1)],
            [6, 8],
        ];

        yield [
            Diff::create(),
            [$gen(2)],
            \range(0, 8, 2),
        ];
    }
}
