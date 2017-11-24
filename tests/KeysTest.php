<?php
namespace Josh\Functional\Test;

use Josh\Functional\Kv;
use Josh\Functional\Keys;

class KeysTest extends TransformTest
{
    public function getTransforms()
    {
        yield Keys::create();
    }

    public function getTestDataForApplyTo()
    {
        yield [Keys::create(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], ['foo', 'hello']];
        yield [Keys::create(), ['foo'], ExpectError::ofType(\Error::class)];
    }
}
