<?php
namespace SnowIO\Transform;

final class Identity implements Transform
{
    use FluentTransformTrait;

    public static function get(): Transform
    {
        return self::$instance;
    }

    public function applyTo($input): \Iterator
    {
        if ($input instanceof \Iterator) {
            return $input;
        }
        if ($input instanceof \IteratorAggregate) {
            return $input->getIterator();
        }
        if (\is_array($input)) {
            return new \ArrayIterator($input);
        }
        assertIterable($input);
        return $this->getIterator($input);
    }

    private static $instance;

    private function getIterator($iterable): \Iterator
    {
        yield from $iterable;
    }

    /**
     * @internal
     */
    public static function init()
    {
        $transform = new self;
        self::$instance = $transform;
    }
}

Identity::init();
