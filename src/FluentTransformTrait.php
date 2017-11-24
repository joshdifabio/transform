<?php
namespace Joshdifabio\Transform;

trait FluentTransformTrait
{
    public function then(Transform $transform): Transform
    {
        return Pipeline::of($this, $transform);
    }
}
