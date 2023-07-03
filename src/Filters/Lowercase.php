<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function is_string;
use function mb_strtolower;

#[Attribute]
class Lowercase implements FilterInterface
{
  /**
   * `mb_strtolower` function only accepts strings.
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * Apply `mb_strtolower function.
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return mb_strtolower($propertyValue);
  }
}
