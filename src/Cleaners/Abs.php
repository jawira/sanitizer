<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use function abs;
use function is_float;
use function is_int;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
/**
 * @deprecated Renamed, please use {@see \Jawira\Sanitizer\Cleaners\Absolute} instead.
 */
class Abs implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_int($value) || is_float($value);
  }

  public function filter(mixed $value): int|float
  {
    assert(is_int($value) || is_float($value));

    return abs($value);
  }
}
