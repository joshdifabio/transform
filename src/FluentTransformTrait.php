<?php
namespace SnowIO\Transform;

trait FluentTransformTrait
{
    public function then(Transform $transform): Transform
    {
        return Pipeline::of($this, $transform);
    }
}
