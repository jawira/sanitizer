<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class Abs implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (is_int($value)) {
      return true;
    }
    if (is_float($value)) {
      return true;
    }

    return false;
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return abs($value);
  }
}
