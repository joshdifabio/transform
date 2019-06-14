<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Kv;
use SnowIO\Transform\Values;

class ValuesTest extends TransformTest
{
    public function getTransforms()
    {
        yield Values::get();
        yield Values::withKeysAppliedToIterator();
    }

    public function getTestDataForApplyTo()
    {
        yield [Values::get(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['bar', 'world']];
        yield [Values::get(), ['foo'], ExpectError::ofType(\TypeError::class)];
        yield [Values::withKeysAppliedToIterator(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['foo' => 'bar', 'hello' => 'world']];
    }
}
