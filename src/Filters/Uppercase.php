<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_string;
use function mb_strtoupper;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Uppercase implements FilterInterface
{
  /**
   * `mb_strtoupper` function only accepts strings.
   */
  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * Apply `mb_strtoupper` function.
   */
  public function filter(mixed $value): string
  {
    assert(is_string($value));
    return mb_strtoupper($value);
  }
}
