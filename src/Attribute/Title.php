<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Attribute;

use Attribute;
use const MB_CASE_TITLE;
use function assert;
use function is_string;
use function mb_convert_case;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Title implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return mb_convert_case($value, MB_CASE_TITLE);
  }
}
