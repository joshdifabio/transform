<?php
namespace Joshdifabio\Transform;

final class Keys
{
    public static function create(): Transform
    {
        return MapElements::via(Kv::key());
    }
}
