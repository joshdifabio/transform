<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Concat;

class ConcatTest extends TransformTest
{
    public function testApplyToThrowsWhenElementIsNonIterable()
    {
        try {
            $result = Concat::iterables()->applyTo(['foo']);
            \iterator_to_array($result);
        } catch (\Exception $e) {
            self::assertInstanceOf(\Exception::class, $e);
            self::assertSame('Provided value must be an array or an instance of Traversable.', $e->getMessage());
            return;
        }
        self::fail();
    }

    public function getTransforms()
    {
        yield Concat::iterables();
    }

    public function getTestDataForApplyTo()
    {
        yield [
            Concat::iterables(),
            [[1, 2, 3], [4, 5], [6]],
            \range(1, 6),
        ];
    }
}
