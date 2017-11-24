<?php
namespace Josh\Functional\Test;

use Josh\Functional\Pipeline;
use Josh\Functional\Filter;
use Josh\Functional\Identity;
use Josh\Functional\Kv;
use Josh\Functional\Values;
use Josh\Functional\WithKeys;

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
