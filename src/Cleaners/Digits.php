<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use function assert;
use function is_string;
use function preg_replace;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Digits implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return preg_replace('#\D+#', '', $value);
  }
}
