<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use function assert;
use function is_float;
use function is_int;
use function min;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class AtMost implements CleanerInterface
{
  public function __construct(private int|float $number = 0)
  {
  }

  public function precondition(mixed $value): bool
  {
    if (!is_int($value) && !is_float($value)) {
      return false;
    }

    return $this->number < $value;
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return min($this->number, $value);
  }
}
