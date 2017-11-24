<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\WithKeys;

class WithKeysTest extends TransformTest
{
    public function getTransforms()
    {
        yield WithKeys::of(function () { return 1; });
        yield WithKeys::ofInputIterable();
    }

    public function getTestDataForApplyTo()
    {
        yield [WithKeys::of(function () { return 1; }), [], []];
        yield [WithKeys::of(function () { return 1; }), ['foo'], [Kv::of(1, 'foo')]];
        yield [WithKeys::of(function () { return 1; }), ['foo', 'bar'], [Kv::of(1, 'foo'), Kv::of(1, 'bar')]];
        yield [WithKeys::of(function ($v) { return $v; }), ['foo'], [Kv::of('foo', 'foo')]];
        yield [WithKeys::of(function () { return null; }), ['foo'], [Kv::of(null, 'foo')]];
        yield [WithKeys::ofInputIterable(), [5 => 'foo', 'hello' => 'world'], [Kv::of(5, 'foo'), Kv::of('hello', 'world')]];
    }
}
