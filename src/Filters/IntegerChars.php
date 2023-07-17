<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function filter_var;
use function is_string;
use const FILTER_SANITIZE_NUMBER_INT;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class IntegerChars implements FilterInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));
    $result = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    assert(is_string($result));

    return $result;
  }
}
