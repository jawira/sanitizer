<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Trim implements FilterInterface
{
  /**
   * {@inheritDoc}
   */
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  /**
   * {@inheritDoc}
   */
  public function filter(mixed $propertyValue): mixed
  {
    return trim($propertyValue);
  }
}
