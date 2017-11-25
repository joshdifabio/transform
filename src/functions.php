<?php
namespace Joshdifabio\Transform;

function assertIterable($value) {
    if (!\is_iterable($value)) {
        throw new \Exception('Provided value must be an array or an instance of Traversable.');
    }
}

function identity($arg) {
    return $arg;
}

function identityFn(): callable {
    return function ($arg) {
        return $arg;
    };
}
