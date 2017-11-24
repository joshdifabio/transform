<?php
namespace Joshdifabio\Transform\Test;

use JoshDiFabio\Transform\Kv;
use Joshdifabio\Transform\Values;

class ValuesTest extends TransformTest
{
    public function getTransforms()
    {
        yield Values::get();
    }

    public function getTestDataForApplyTo()
    {
        yield [Values::get(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['bar', 'world']];
        yield [Values::get(), ['foo'], ExpectError::ofType(\TypeError::class)];
    }
}
