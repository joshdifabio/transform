<?php
namespace SnowIO\Transform;

final class Filter
{
    public static function by(callable $predicate): Transform
    {
        return FlatMapElements::via(function ($element) use ($predicate) {
            if ($predicate($element)) {
                yield $element;
            }
        });
    }

    public static function equalTo($value): Transform
    {
        return Filter::by(function ($element) use ($value) {
            return $element === $value;
        });
    }

    public static function notEqualTo($value): Transform
    {
        return Filter::by(function ($element) use ($value) {
            return $element !== $value;
        });
    }

    public static function byKey(callable $predicate): Transform
    {
        return Filter::by(function (Kv $element) use ($predicate) {
            return $predicate($element->getKey());
        });
    }

    public static function keyEqualTo($value): Transform
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getKey() === $value;
        });
    }

    public static function keyNotEqualTo($value): Transform
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getKey() !== $value;
        });
    }

    public static function byValue(callable $predicate): Transform
    {
        return Filter::by(function (Kv $element) use ($predicate) {
            return $predicate($element->getValue());
        });
    }

    public static function valueEqualTo($value): Transform
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getValue() === $value;
        });
    }

    public static function valueNotEqualTo($value): Transform
    {
        return Filter::by(function (Kv $element) use ($value) {
            return $element->getValue() !== $value;
        });
    }

    private function __construct()
    {

    }
}
