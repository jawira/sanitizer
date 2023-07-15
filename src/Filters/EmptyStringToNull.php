<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
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
