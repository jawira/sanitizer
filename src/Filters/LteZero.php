<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_float;
use function is_int;
use function min;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class LteZero implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (!is_int($value) && !is_float($value)) {
      return false;
    }

    return 0 < $value;
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return min(0, $value);
  }
}
