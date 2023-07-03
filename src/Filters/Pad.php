<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Pad implements FilterInterface
{
  public const BOTH = 'both';
  public const LEFT = 'left';
  public const RIGHT = 'right';

  public function __construct(private int    $length,
                              private string $padString = ' ',
                              private string $direction = self::RIGHT)
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
    $padType = match ($this->direction) {
      self::LEFT => \STR_PAD_LEFT,
      self::RIGHT => \STR_PAD_RIGHT,
      self::BOTH => \STR_PAD_BOTH,
    };

    return str_pad($propertyValue, $this->length, $this->padString, $padType);
  }
}
