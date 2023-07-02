<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class TrimRight implements FilterInterface
{
  public function __construct(private string $characters = " \t\n\r\0\x0B")
  {
  }

  /**
   * `rtrim function only accepts strings.
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * Apply `rtrim` function.
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return rtrim($propertyValue, $this->characters);
  }
}