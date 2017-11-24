<?php
namespace Josh\Functional\Test;

use Josh\Functional\FlatMapElements;

class FlatMapElementsTest extends TransformTest
{
    public function getTransforms()
    {
        yield FlatMapElements::via(function (int $n) {
            for ($i = 1; $i <= $n; $i++) {
                yield $i;
            }
        });
    }

    public function getTestDataForApplyTo()
    {
        yield [
            FlatMapElements::via(function (int $n) {
                for ($i = 1; $i <= $n; $i++) {
                    yield $i;
                }
            }),
            \range(1, 3),
            [1, 1, 2, 1, 2, 3],
        ];
    }
}
