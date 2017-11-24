<?php
namespace Joshdifabio\Transform\Test;

use Joshdifabio\Transform\Kv;
use Joshdifabio\Transform\Transform;
use PHPUnit\Framework\TestCase;

abstract class TransformTest extends TestCase
{
    /**
     * @dataProvider getWrappedTransforms
     */
    public function testApplyToThrowsWhenProvidedNonIterable(Transform $transform)
    {
        try {
            \iterator_to_array($transform->applyTo('foo'));
        } catch (\Exception $e) {
            self::assertInstanceOf(\Exception::class, $e);
            self::assertSame('Provided value must be an array or an instance of Traversable.', $e->getMessage());
            return;
        }
        self::fail();
    }

    public function getWrappedTransforms()
    {
        foreach ($this->getTransforms() as $transform) {
            yield [$transform];
        }
    }

    abstract public function getTransforms();

    /**
     * @dataProvider getTestDataForApplyTo
     */
    public function testApplyTo(Transform $transform, $input, $expectedOutput)
    {
        try {
            $output = $transform->applyTo($input);
            $outputArray = \iterator_to_array($output);
        } catch (\Throwable $e) {
            self::handleError($expectedOutput, $e);
            return;
        }
        self::assertSameSize($expectedOutput, $outputArray);
        foreach ($expectedOutput as $index => $expectedValue) {
            self::assertArrayHasKey($index, $outputArray);
            $actualValue = $outputArray[$index];
            if ($expectedValue instanceof Kv) {
                self::assertInstanceOf(Kv::class, $actualValue);
                /** @var Kv $actualValue */
                self::assertSame($expectedValue->getKey(), $actualValue->getKey());
                self::assertSame($expectedValue->getValue(), $actualValue->getValue());
            } else {
                self::assertSame($expectedValue, $actualValue);
            }
        }
    }

    public function getTestDataForApplyTo()
    {
        return [];
    }

    private static function handleError($expectedOutput, \Throwable $actualError)
    {
        if (!\is_callable($expectedOutput)) {
            throw $actualError;
        }
        $expectedOutput($actualError);
    }
}
