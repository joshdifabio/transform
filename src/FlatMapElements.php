<?php
namespace Josh\Functional;

final class FlatMapElements implements Transform
{
    use SingularTransformTrait;

    public static function via(callable $fn): Transform
    {
        $transform = new self;
        $transform->fn = $fn;
        return $transform;
    }

    public static function viaTransform(Transform $transform): Transform
    {
        return FlatMapElements::via([$transform, 'applyTo']);
    }

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $inputElement) {
            $fnOutput = ($this->fn)($inputElement) ?? [];
            assertIterable($fnOutput);
            foreach ($fnOutput as $outputElement) {
                yield $outputElement;
            }
        }
    }

    private $fn;
}
