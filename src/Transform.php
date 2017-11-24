<?php
namespace Joshdifabio\Transform;

interface Transform
{
    /**
     * @param array|\Traversable $input
     */
    public function applyTo($input): \Iterator;

    public function then(Transform $transform): Transform;
}
