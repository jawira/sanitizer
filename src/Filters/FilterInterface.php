<?php

namespace Jawira\Sanitizer\Filters;

interface FilterInterface
{
  /**
   * Can you use this filter with this value?
   *
   * Be as strict as possible to be sure you can apply filter later.
   */
  public function check(mixed $propertyValue): bool;

  /**
   * Apply the filter to sanitize the value.
   *
   * You must return a value. Because input value is not known you have to
   * implement {@see FilterInterface::check} to be sure you can apply the
   * filter.
   *
   * @param mixed $propertyValue The original value.
   * @return mixed The new sanitized value.
   */
  public function filter(mixed $propertyValue): mixed;
}
