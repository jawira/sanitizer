<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;


interface FilterInterface
{
  /**
   * Can you use this filter with this value?
   *
   * If this condition is not met, the filter will be skipped. Be as strict as
   * possible to be sure you can apply {@see FilterInterface::filter}.
   */
  public function check(mixed $propertyValue): bool;

  /**
   * Apply the filter to sanitize the value.
   *
   * Because input value is `mixed` you have to implement
   * {@see FilterInterface::check} to be sure you can apply the filter.
   *
   * Because return type is `mixed`, please double-check return type will
   * be the expected one.
   */
  public function filter(mixed $propertyValue): mixed;
}
