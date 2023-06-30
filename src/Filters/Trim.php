<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Trim implements FilterInterface
{
  public function __construct(private string $characters = " \t\n\r\0\x0B")
  {
  }

  /**
   * `trim` function only accepts strings.
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * Apply `trim` function.
   *
   * @param string $propertyValue
   * @return string
   */
  public function filter(mixed $propertyValue): mixed
  {
    return trim($propertyValue, $this->characters);
  }
}
