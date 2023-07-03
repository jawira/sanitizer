<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class IntegerChars implements FilterInterface
{
  public function check(mixed $propertyValue): bool
  {
    return \is_string($propertyValue);
  }

  public function filter(mixed $propertyValue): string
  {
    \assert(\is_string($propertyValue));
    $result = \filter_var($propertyValue, \FILTER_SANITIZE_NUMBER_INT);
    \assert(\is_string($result));

    return $result;
  }
}
