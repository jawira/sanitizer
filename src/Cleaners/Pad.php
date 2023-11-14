<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use Jawira\Sanitizer\Enums\Side;
use Jawira\Sanitizer\Exceptions\FilterException;
use function Symfony\Component\String\u;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Pad implements CleanerInterface
{
  public function __construct(private int    $length,
                              private string $padString = ' ',
                              private Side   $side = Side::Right)
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
    is_string($value) ?: throw new FilterException('Pad value must be string');
    assert(is_string($value)); // Tell Psalm $value is string

    $string = u($value);

    $padString = match ($this->side) {
      Side::Left => $string->padStart($this->length, $this->padString),
      Side::Right => $string->padEnd($this->length, $this->padString),
      Side::Both => $string->padBoth($this->length, $this->padString),
    };

    return $padString->toString();
  }
}
