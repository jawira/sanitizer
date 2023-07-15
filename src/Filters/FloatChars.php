<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use function assert;
use function filter_var;
use function is_string;
use const FILTER_FLAG_ALLOW_FRACTION;
use const FILTER_FLAG_ALLOW_SCIENTIFIC;
use const FILTER_FLAG_ALLOW_THOUSAND;
use const FILTER_SANITIZE_NUMBER_FLOAT;

#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
class FloatChars implements FilterInterface
{
  public function __construct(private bool $allowThousand = false,
                              private bool $allowScientific = false)
  {
  }

  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));
    $thousandFlag = $this->allowThousand ? FILTER_FLAG_ALLOW_THOUSAND : 0;
    $scientificFlag = $this->allowScientific ? FILTER_FLAG_ALLOW_SCIENTIFIC : 0;
    $result = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | $thousandFlag | $scientificFlag);
    assert(is_string($result));

    return $result;
  }
}
