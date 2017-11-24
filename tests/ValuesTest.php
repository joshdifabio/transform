<?php
namespace Josh\Functional\Test;

use Josh\Functional\Kv;
use Josh\Functional\Values;

class ValuesTest extends TransformTest
{
    public function getTransforms()
    {
        yield Values::get();
    }

    public function getTestDataForApplyTo()
    {
        yield [Values::get(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['bar', 'world']];
        yield [Values::get(), ['foo'], ExpectError::ofType(\Error::class)];
    }
}
