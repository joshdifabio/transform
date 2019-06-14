<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Kv;
use SnowIO\Transform\KvSwap;

class KvSwapTest extends TransformTest
{
    public function getTransforms()
    {
        yield KvSwap::create();
    }

    public function getTestDataForApplyTo()
    {
        yield [KvSwap::create(), [], []];
        yield [KvSwap::create(), [Kv::of('foo', 'bar'), Kv::of('hello', 'world')], [Kv::of('bar', 'foo'), Kv::of('world', 'hello')]];
    }
}
