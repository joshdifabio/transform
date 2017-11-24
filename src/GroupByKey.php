<?php
namespace Josh\Functional;

final class GroupByKey implements Transform
{
    use SingularTransformTrait;

    public static function create(): Transform
    {
        return new self;
    }

    public static function withKeyHashFn(callable $keyHashFn): Transform
    {
        $transform = new self;
        $transform->keyHashFn = $keyHashFn;
        return $transform;
    }

    public function applyTo($input): \Iterator
    {
        assertIterable($input);
        $result = [];
        $keys = [];
        if ($this->keyHashFn) {
            foreach ($input as $element) {
                if (!$element instanceof Kv) {
                    throw new \Exception;
                }
                /** @var Kv $element */
                $keyHash = ($this->keyHashFn)($element->getKey());
                $keys[$keyHash] = $element->getKey();
                $result[$keyHash][] = $element->getValue();
            }
        } else {
            foreach ($input as $element) {
                if (!$element instanceof Kv) {
                    throw new \Exception;
                }
                /** @var Kv $element */
                $keyHash = (string)($element->getKey());
                $keys[$keyHash] = $element->getKey();
                $result[$keyHash][] = $element->getValue();
            }
        }
        foreach ($result as $keyHash => $elements) {
            yield Kv::of($keys[$keyHash], $elements);
        }
    }

    private $keyHashFn;

    private function __construct()
    {

    }
}
