<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function abs;
use function is_float;
use function is_int;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Abs implements FilterInterface
{
  public function check(mixed $value): bool
  {
    return is_int($value) || is_float($value);
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return abs($value);
  }
}
