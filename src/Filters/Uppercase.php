<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
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
