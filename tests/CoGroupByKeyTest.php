<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\CoGbkResult;
use SnowIO\Transform\CoGroupByKey;
use SnowIO\Transform\Kv;
use SnowIO\Transform\MapValues;

class CoGroupByKeyTest extends TransformTest
{
    public function getTransforms()
    {
        yield CoGroupByKey::create();
    }

    public function getTestDataForApplyTo()
    {
        $transform = CoGroupByKey::create()->then(MapValues::via(function (CoGbkResult $result) {
            return ['en' => $result->getAll('en'), 'it' => $result->getAll('it')];
        }));

        yield [
            $transform,
            [
                Kv::of('en', [
                    Kv::of(1, 'one'),
                    Kv::of(2, 'two'),
                ]),
                Kv::of('it', [
                    Kv::of(1, 'uno'),
                    Kv::of(2, 'due'),
                    Kv::of(3, 'tre'),
                ]),
            ],
            [
                Kv::of(1, ['en' => ['one'], 'it' => ['uno']]),
                Kv::of(2, ['en' => ['two'], 'it' => ['due']]),
                Kv::of(3, ['en' => [], 'it' => ['tre']]),
            ],
        ];
    }
}
