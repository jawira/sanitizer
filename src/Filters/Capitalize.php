<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Capitalize implements FilterInterface
{
  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return mb_convert_case($propertyValue, MB_CASE_TITLE);
  }
}
