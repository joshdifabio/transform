<?php
namespace Josh\Functional;

final class Pipeline implements Transform
{
    public static function of(Transform ...$transforms): Transform
    {
        $transforms = \array_filter($transforms, function (Transform $transform) {
            return !$transform instanceof Identity;
        });
        if (empty($transforms)) {
            return Identity::get();
        }
        $firstTransform = \array_shift($transforms);
        if (empty($transforms)) {
            return $firstTransform;
        }
        $pipeline = new self;
        $pipeline->members = [$firstTransform];
        foreach ($transforms as $transform) {
            $pipeline = $pipeline->then($transform);
        }
        return $pipeline;
    }

    public function applyTo($input): \Iterator
    {
        foreach ($this->members as $member) {
            $input = $member->applyTo($input);
        }
        return $input;
    }

    public function then(Transform $transform): Transform
    {
        $pipeline = clone $this;
        $pipeline->members[] = $transform;
        return $pipeline;
    }

    /** @var Transform[] */
    private $members;

    private function __construct()
    {

    }
}
