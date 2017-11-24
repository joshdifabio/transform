<?php
namespace Joshdifabio\Transform\Test;

use PHPUnit\Framework\TestCase;

class ExpectError
{
    public static function ofAnyType(): self
    {
        return self::withSuperType(\Throwable::class);
    }

    public static function ofType(string $class): self
    {
        $matcher = new self;
        $matcher->typeAssertion = function (string $actualClass) use ($class) {
            TestCase::assertSame($class, $actualClass, "Error class is not as expected.");
        };
        $matcher->messageAssertion = function () {};
        return $matcher;
    }

    public static function withSuperType(string $class): self
    {
        $matcher = new self;
        $matcher->typeAssertion = function (string $actualClass) use ($class) {
            TestCase::assertTrue(\is_subclass_of($actualClass, $class), "Error class $actualClass is not a subtype of $class.");
        };
        $matcher->messageAssertion = function () {};
        return $matcher;
    }

    public function withMessage(string $message): self
    {
        $matcher = clone $this;
        $matcher->messageAssertion = function (string $actualMessage) use ($message) {
            TestCase::assertSame($message, $actualMessage, "Error message is not as expected.");
        };
        return $matcher;
    }

    public function __invoke(\Throwable $error)
    {
        ($this->typeAssertion)(\get_class($error));
        ($this->messageAssertion)($error->getMessage());
    }

    private $typeAssertion;
    private $messageAssertion;

    private function __construct()
    {

    }
}
