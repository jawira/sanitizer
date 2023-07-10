<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class GteZero implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (!\is_int($value) && !\is_float($value)) {
      return false;
    }

    return $value < 0;
  }

  public function filter(mixed $value): mixed
  {
    \assert(\is_int($value) || \is_float($value));

    return \max(0, $value);
  }
}
