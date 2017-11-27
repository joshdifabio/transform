<?php
namespace Joshdifabio\Transform;

final class KvSwap
{
    public static function create(): Transform
    {
        return MapElements::via(function (Kv $element) {
            return Kv::of($element->getValue(), $element->getKey());
        });
    }
}
