<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_float;
use function is_int;
use function max;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class GteZero implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (!is_int($value) && !is_float($value)) {
      return false;
    }

    return $value < 0;
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return max(0, $value);
  }
}
