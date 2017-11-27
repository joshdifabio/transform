<?php
namespace Joshdifabio\Transform;

class Distinct
{
    public static function create(): Transform
    {
        return Pipeline::of(
            MapElements::via(function ($element) {
                return Kv::of($element, null);
            }),
            GroupByKey::create(),
            Keys::create()
        );
    }

    public static function withRepresentativeValueFn(callable $fn): Transform
    {
        return Pipeline::of(
            WithKeys::of($fn),
            GroupByKey::create(),
            MapElements::via(function (Kv $kv) {
                foreach ($kv->getValue() as $element) {
                    return $element;
                }
            })
        );
    }
}
