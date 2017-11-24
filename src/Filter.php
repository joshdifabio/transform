<?php
namespace Joshdifabio\Transform;

final class Filter implements Transform
{
    use FluentTransformTrait;

    public static function by(callable $predicate): self
    {
        $transform = new self;
        $transform->fn = $predicate;
        return $transform;
    }

    public static function equalTo($value): self
    {
        return Filter::by(function ($element) use ($value) {
            return $element === $value;
        });
    }

    public static function notEqualTo($value): self
    {
        return Filter::by(function ($element) use ($value) {
            return $element !== $value;
        });
    }

    public static function byKey(callable $predicate): self
    {
        return Filter::by(function (Kv $element) use ($predicate) {
            return $predicate($element->getKey());
        });
    }

    public static function keyEqualTo($value): self
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getKey() === $value;
        });
    }

    public static function keyNotEqualTo($value): self
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getKey() !== $value;
        });
    }

    public static function byValue(callable $predicate): self
    {
        return Filter::by(function (Kv $element) use ($predicate) {
            return $predicate($element->getValue());
        });
    }

    public static function valueEqualTo($value): self
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getValue() === $value;
        });
    }

    public static function valueNotEqualTo($value): self
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getValue() !== $value;
        });
    }

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        foreach ($input as $element) {
            if (($this->fn)($element)) {
                yield $element;
            }
        }
    }

    private $fn;
}
