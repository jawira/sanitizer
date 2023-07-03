<?php

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class GteZero implements FilterInterface
{
  public function check(mixed $propertyValue): bool
  {
    if (!\is_int($propertyValue) && !\is_float($propertyValue)) {
      return false;
    }

    return $propertyValue < 0;
  }

  public function filter(mixed $propertyValue): mixed
  {
    \assert(\is_int($propertyValue) || \is_float($propertyValue));

    return \max(0, $propertyValue);
  }
}
