<?php
namespace Joshdifabio\Transform;

final class Kv
{
    public static function of($key, $value): self
    {
        $kv = new self;
        $kv->key = $key;
        $kv->value = $value;
        return $kv;
    }

    public static function key(): callable
    {
        return function (Kv $kv) {
            return $kv->getKey();
        };
    }

    public static function keyMappedVia(callable $fn): callable
    {
        return function (Kv $kv) use ($fn) {
            return $fn($kv->getKey());
        };
    }

    public static function value(): callable
    {
        return function (Kv $kv) {
            return $kv->getValue();
        };
    }

    public static function valueMappedVia(callable $fn): callable
    {
        return function (Kv $kv) use ($fn) {
            return $fn($kv->getValue());
        };
    }

    public static function unpack(callable $fn): callable
    {
        return function (Kv $kv) use ($fn) {
            return $fn($kv->getKey(), $kv->getValue());
        };
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    private $key;
    private $value;

    private function __construct()
    {

    }
}
