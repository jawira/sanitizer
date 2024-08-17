<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use const FILTER_SANITIZE_NUMBER_INT;
use function assert;
use function filter_var;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class IntegerChars implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));
    $result = filter_var($value, FILTER_SANITIZE_NUMBER_INT);

    return $result;
  }
}
