<?php
namespace Joshdifabio\Transform;

class Values
{
    public static function get(): Transform
    {
        return MapElements::via(Kv::value());
    }
}
