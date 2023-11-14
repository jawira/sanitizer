<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use function intval;
use function is_array;
use function is_int;
use function is_null;
use function is_scalar;

/**
 * @see https://www.php.net/manual/en/language.types.integer.php#language.types.integer.casting
 */
#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class ToInt implements CleanerInterface
{
  public function __construct(
    /**
     * Base is only used when value is a string.
     *
     * Base 0 works as "auto" mode with strings.
     */
    private int $base = 10
  ) {
  }

  /**
   * Check if filtering can be done.
   *
   * Object are not accepted because `intval` will print a warning.
   */
  public function precondition(mixed $value): bool
  {
    if (is_int($value)) {
      return false;
    }

    return is_null($value) || is_scalar($value) || is_array($value);
  }

  public function filter(mixed $value): int
  {
    return intval($value, $this->base);
  }
}
