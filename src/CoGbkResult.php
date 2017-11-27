<?php
namespace Joshdifabio\Transform;

final class CoGbkResult
{
    public static function empty(): self
    {
        return new self;
    }

    public static function of($collectionKey, array $values): self
    {
        return self::empty()->and($collectionKey, $values);
    }

    public function and($collectionKey, array $values): self
    {
        $result = clone $this;
        $result->valuesPerCollection[$collectionKey] = $values;
        return $result;
    }

    public function getAll($collectionKey): array
    {
        return $this->valuesPerCollection[$collectionKey] ?? [];
    }

    public function getOnly($collectionKey)
    {
        if (\count($this->valuesPerCollection[$collectionKey] ?? []) != 1) {
            throw new \Exception;
        }
        return $this->valuesPerCollection[$collectionKey][0];
    }

    public function getOptional($collectionKey)
    {
        if (\count($this->valuesPerCollection[$collectionKey] ?? []) > 1) {
            throw new \Exception;
        }
        return $this->valuesPerCollection[$collectionKey][0] ?? null;
    }

    private $valuesPerCollection = [];

    private function __construct()
    {

    }
}
