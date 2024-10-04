<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Attribute;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class EmptyStringToNull implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return $value === '';
  }

  public function filter(mixed $value): mixed
  {
    return $value === '' ? null : $value;
  }
}
