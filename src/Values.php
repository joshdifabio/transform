<?php
namespace Josh\Functional;

class Values
{
    public static function get(): Transform
    {
        return MapElements::viaMethod('getValue');
    }
}
