<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use Jawira\Sanitizer\Enums\Side;
use function assert;
use function is_string;
use function ltrim;
use function rtrim;
use function trim;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Trim implements FilterInterface
{
  public function __construct(private string $characters = " \t\n\r\0\x0B",
                              private Side   $side = Side::Both)
  {
  }

  /**
   * `trim` function only accepts strings.
   */
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * Apply `trim` function.
   */
  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return match ($this->side) {
      Side::Left => ltrim($value, $this->characters),
      Side::Right => rtrim($value, $this->characters),
      Side::Both => trim($value, $this->characters),
    };
  }
}
