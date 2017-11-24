<?php
namespace Joshdifabio\Transform;

final class MapElements implements Transform
{
    use FluentTransformTrait;

    public static function via(callable $fn): Transform
    {
        $transform = new self;
        $transform->fn = $fn;
        return $transform;
    }

    public static function viaMethod(string $methodName): Transform
    {
        return MapElements::via(function ($element) use ($methodName) {
            return $element->$methodName();
        });
    }

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $inputElement) {
            yield ($this->fn)($inputElement);
        }
    }

    private $fn;
}
