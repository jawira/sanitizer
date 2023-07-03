<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class Ascii implements FilterInterface
{
  public function __construct(private bool $onlyPrintable = false)
  {
  }

  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  public function filter(mixed $propertyValue): string
  {
    $options = $this->onlyPrintable ? \FILTER_FLAG_STRIP_LOW | \FILTER_FLAG_STRIP_HIGH : \FILTER_FLAG_STRIP_HIGH;
    assert(is_string($propertyValue));
    $result = filter_var($propertyValue, \FILTER_UNSAFE_RAW, $options);
    assert(is_string($result));

    return $result;
  }
}
