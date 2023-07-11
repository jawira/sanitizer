<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class EmptyStringToNull implements FilterInterface
{

  public function check(mixed $value): bool
  {
    return $value === '';
  }

  public function filter(mixed $value): mixed
  {
    return $value === '' ? null : $value;
  }
}
