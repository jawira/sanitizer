<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

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
   *
   * @param string $propertyValue
   * @return string
   */
  public function filter(mixed $propertyValue): mixed
  {
    return mb_strtolower($propertyValue);
  }
}
