<?php

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class FloatChars implements FilterInterface
{
  public function __construct(private bool $allowThousand = false,
                              private bool $allowScientific = false)
  {
  }

  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  public function filter(mixed $propertyValue): string
  {
    \assert(\is_string($propertyValue));
    $thousandFlag = $this->allowThousand ? \FILTER_FLAG_ALLOW_THOUSAND : 0;
    $scientificFlag = $this->allowScientific ? \FILTER_FLAG_ALLOW_SCIENTIFIC : 0;
    $result = \filter_var($propertyValue, \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION | $thousandFlag | $scientificFlag);
    \assert(\is_string($result));

    return $result;
  }
}
