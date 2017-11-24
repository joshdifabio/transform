<?php
namespace Josh\Functional;

class Keys
{
    public static function create(): Transform
    {
        return MapElements::viaMethod('getKey');
    }
}
