<?php

namespace Jawira\Sanitizer\Filters;

use Attribute;

#[Attribute]
class Trim implements FilterInterface
{
  public function preConditions(mixed $data): bool
  {
    return is_string($data);
  }

  public function filter(mixed $data): mixed
  {
    return trim($data);
  }
}
