<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

/**
 * @see https://www.php.net/manual/en/language.types.integer.php#language.types.integer.casting
 */
#[\Attribute]
class ToInt implements FilterInterface
{
  public function __construct(
    /**
     * Base is only used when value is a string.
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
  public function check(mixed $value): bool
  {
    return is_bool($value) || is_float($value) || is_string($value) || is_null($value) || is_array($value);
  }

  public function filter(mixed $value): int
  {
    return intval($value, $this->base);
  }
}
