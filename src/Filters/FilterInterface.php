<?php

namespace Jawira\Sanitizer\Filters;

interface FilterInterface
{
  public function preConditions(mixed $data): bool;

  public function filter(mixed $data): mixed;
}
