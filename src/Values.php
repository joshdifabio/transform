<?php
namespace Joshdifabio\Transform;

final class Values
{
    public static function get(): Transform
    {
        return MapElements::via(Kv::value());
    }
}
