<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use Stringable;
use function assert;
use function is_null;
use function is_scalar;
use function strval;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class ToString implements FilterInterface
{
  public function check(mixed $value): bool
  {
    if (\is_string($value)) {
      return false;
    }

    return is_null($value) || is_scalar($value) || ($value instanceof Stringable);
  }

  public function filter(mixed $value): string
  {
    assert(is_null($value) || is_scalar($value) || ($value instanceof Stringable));

    return strval($value);
  }
}
