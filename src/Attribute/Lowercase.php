<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Attribute;

use Attribute;
use function assert;
use function is_string;
use function mb_strtolower;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Lowercase implements CleanerInterface
{
  /**
   * `mb_strtolower` function only accepts strings.
   */
  public function precondition(mixed $value): bool
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
