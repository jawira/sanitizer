<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class IntegerChars implements FilterInterface
{
  public function check(mixed $value): bool
  {
    return \is_string($value);
  }

  public function filter(mixed $value): string
  {
    \assert(\is_string($value));
    $result = \filter_var($value, \FILTER_SANITIZE_NUMBER_INT);
    \assert(\is_string($result));

    return $result;
  }
}
