<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class LteZero implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (!\is_int($value) && !\is_float($value)) {
      return false;
    }

    return 0 < $value;
  }

  public function filter(mixed $value): mixed
  {
    \assert(\is_int($value) || \is_float($value));

    return \min(0, $value);
  }
}
