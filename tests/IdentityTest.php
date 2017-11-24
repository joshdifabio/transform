<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Identity;
use PHPUnit\Framework\TestCase;

class IdentityTest extends TestCase
{
    public function testApplyTo()
    {
        $transform = Identity::get();

        $arrayResult = $transform->applyTo([1, 2, 3]);
        self::assertSame([1, 2, 3], \iterator_to_array($arrayResult));

        $iterator = new \ArrayIterator([1, 2, 3]);
        $iteratorResult = $transform->applyTo($iterator);
        self::assertSame($iterator, $iteratorResult);

        $iteratorAggregate = $this->getIteratorAggregate($iterator);
        $iteratorAggregateResult = $transform->applyTo($iteratorAggregate);
        self::assertSame($iterator, $iteratorAggregateResult);
    }

    private function getIteratorAggregate(\Iterator $iterator): \IteratorAggregate
    {
        return new class ($iterator) implements \IteratorAggregate {
            private $iterator;

            public function __construct($iterator)
            {
                $this->iterator = $iterator;
            }

            public function getIterator()
            {
                return $this->iterator;
            }
        };
    }
}
