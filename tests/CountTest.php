<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Count;
use Joshdifabio\Transform\Kv;

class CountTest extends TransformTest
{
    public function getTransforms()
    {
        yield Count::globally();
        yield Count::perKey();
    }

    public function getTestDataForApplyTo()
    {
        yield [Count::globally(), [1, 2, 3], [3]];
        yield [Count::perKey(), [Kv::of(1, 'bar'), Kv::of(1, 'bar'), Kv::of('foo', 'bar')], [Kv::of(1, 2), Kv::of('foo', 1)]];
    }
}
