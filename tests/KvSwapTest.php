<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\KvSwap;

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
