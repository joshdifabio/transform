<?php
namespace Josh\Functional;

function assertIterable($value) {
    if (!\is_iterable($value)) {
        throw new \Exception('Provided value must be an array or an instance of Traversable.');
    }
}
