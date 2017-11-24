<?php
namespace Josh\Functional;

trait SingularTransformTrait
{
    public function then(Transform $transform): Transform
    {
        return Pipeline::of($this, $transform);
    }
}
