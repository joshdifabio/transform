<?php
namespace SnowIO\Transform\Test;

use SnowIO\Transform\Pipeline;
use SnowIO\Transform\Filter;
use SnowIO\Transform\Identity;
use SnowIO\Transform\Kv;
use SnowIO\Transform\Values;
use SnowIO\Transform\WithKeys;

class PipelineTest extends TransformTest
{
    public function getTransforms()
    {
        return [];
    }

    public function getTestDataForApplyTo()
    {
        yield [
            Pipeline::of(
                Filter::notEqualTo(null),
                WithKeys::of(function (int $element): string {
                    return $element % 2 == 0 ? 'even' : 'odd';
                }),
                Filter::by(function (Kv $element) {
                    return $element->getKey() === 'even';
                }),
                Values::get()
            ),
            [1, null, 2, 3, 4, 5, null],
            [2, 4],
        ];
    }

    public function testOfWithZeroArgsReturnsIdentity()
    {
        self::assertSame(Identity::get(), Pipeline::of());
    }

    public function testOfWithSingleArgReturnsArg()
    {
        $transform = WithKeys::ofInputIterable();
        self::assertSame($transform, Pipeline::of($transform));
    }

    public function testOfWithSingleNonIdentityArgReturnsArg()
    {
        $transform = WithKeys::ofInputIterable();
        self::assertSame($transform, Pipeline::of(Identity::get(), $transform, Identity::get()));
    }
}
