<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Kv;
use SnowIO\Transform\Keys;

class KeysTest extends TransformTest
{
    public function getTransforms()
    {
        yield Keys::create();
    }

    public function getTestDataForApplyTo()
    {
        yield [Keys::create(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['foo', 'hello']];
        yield [Keys::create(), ['foo'], ExpectError::ofType(\TypeError::class)];
    }
}
