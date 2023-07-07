<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function is_string;
use function mb_strtolower;

#[Attribute]
class Lowercase implements FilterInterface
{
  /**
   * `mb_strtolower` function only accepts strings.
   */
  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * Apply `mb_strtolower function.
   */
  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return mb_strtolower($value);
  }
}
