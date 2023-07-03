<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Trim implements FilterInterface
{
  public const BOTH = 'both';
  public const LEFT = 'left';
  public const RIGHT = 'right';

  public function __construct(private string $characters = " \t\n\r\0\x0B",
                              private string $direction = self::BOTH)
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
   */
  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return match ($this->direction) {
      self::LEFT => ltrim($propertyValue, $this->characters),
      self::RIGHT => rtrim($propertyValue, $this->characters),
      default => trim($propertyValue, $this->characters),
    };
  }
}
