<?php

namespace Jawira\Sanitizer\Filters;

interface FilterInterface
{
  /**
   * Can you use this filter with this value?
   *
   * Be as strict as possible to be sure you can
   * apply {@see FilterInterface::filter}.
   */
  public function check(mixed $propertyValue): bool;

  /**
   * Apply the filter to sanitize the value.
   *
   * You must return a value. Because input value is not known you have to
   * implement {@see FilterInterface::check} to be sure you can apply the
   * filter.
   *
   * Unless you know what you are doing, the return type must be the same as
   * parameter type.
   */
  public function filter(mixed $propertyValue);
}
