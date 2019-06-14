<?php
namespace SnowIO\Transform;

final class FlatMapElements implements Transform
{
    use FluentTransformTrait;

    public static function via(callable $fn): Transform
    {
        $transform = new self;
        $transform->fn = $fn;
        return $transform;
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

    public function getFn(): callable
    {
        return $this->fn;
    }

    private $fn;
}
