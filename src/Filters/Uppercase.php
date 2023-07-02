<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Uppercase implements FilterInterface
{
  /**
   * `mb_strtoupper` function only accepts strings.
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * Apply `mb_strtoupper` function.
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));
    return mb_strtoupper($propertyValue);
  }
}
