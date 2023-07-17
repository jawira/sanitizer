<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_float;
use function is_int;
use function max;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class AtLeast implements FilterInterface
{
  public function __construct(private int|float $number = 0)
  {
  }

  public function precondition(mixed $value): bool
  {
    if (!is_int($value) && !is_float($value)) {
      return false;
    }

    return $value < $this->number;
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return max($this->number, $value);
  }
}
