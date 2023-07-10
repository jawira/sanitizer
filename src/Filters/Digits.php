<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class Digits implements FilterInterface
{
  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return preg_replace('#\D+#', '', $value);
  }
}
