<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use const STR_PAD_BOTH;

#[Attribute]
class PadBoth implements FilterInterface
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
   * Apply `str_pad` function with both sides padding .
   *
   * @param mixed $propertyValue
   * @return string
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return str_pad($propertyValue, $this->length, $this->padString, STR_PAD_BOTH);
  }
}
