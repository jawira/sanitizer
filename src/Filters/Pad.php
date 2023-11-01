<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use Jawira\Sanitizer\Enums\Side;
use const STR_PAD_BOTH;
use const STR_PAD_LEFT;
use const STR_PAD_RIGHT;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Pad implements FilterInterface
{
  public function __construct(private readonly int    $length,
                              private readonly string $padString = ' ',
                              private readonly Side   $side = Side::Right)
  {
  }

  /**
   * `str_pad` function only accepts strings.
   */
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * Apply `str_pad` function adding pad to the right.
   */
  public function filter(mixed $value): string
  {
    assert(is_string($value));
    $padType = match ($this->side) {
      Side::Left => STR_PAD_LEFT,
      Side::Right => STR_PAD_RIGHT,
      Side::Both => STR_PAD_BOTH,
    };

    return str_pad($value, $this->length, $this->padString, $padType);
  }
}
