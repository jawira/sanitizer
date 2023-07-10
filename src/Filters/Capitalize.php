<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Capitalize implements FilterInterface
{
  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));

    return mb_convert_case($value, MB_CASE_TITLE);
  }
}
