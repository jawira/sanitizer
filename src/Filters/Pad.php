<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Pad implements FilterInterface
{
  public function __construct(private int $length, private string $padString = ' ')
  {
  }

  /**
   * `str_pad` function only accepts strings.
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * Apply `str_pad` function adding pad to the right.
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return str_pad($propertyValue, $this->length, $this->padString);
  }
}
