<?php

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class LteZero implements FilterInterface
{

  public function check(mixed $propertyValue): bool
  {
    if (!\is_int($propertyValue) && !\is_float($propertyValue)) {
      return false;
    }

    return 0 < $propertyValue;
  }

  public function filter(mixed $propertyValue): mixed
  {
    \assert(\is_int($propertyValue) || \is_float($propertyValue));

    return \min(0, $propertyValue);
  }
}
