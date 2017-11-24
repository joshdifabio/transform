<?php
namespace Joshdifabio\Transform;

class Keys
{
    public static function create(): Transform
    {
        return MapElements::via(Kv::key());
    }
}
