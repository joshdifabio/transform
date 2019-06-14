<?php
namespace SnowIO\Transform;

final class Keys
{
    public static function create(): Transform
    {
        return MapElements::via(Kv::key());
    }
}
