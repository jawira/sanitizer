<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Attribute;

use Attribute;
use const FILTER_FLAG_STRIP_HIGH;
use const FILTER_FLAG_STRIP_LOW;
use const FILTER_UNSAFE_RAW;
use function assert;
use function filter_var;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Ascii implements CleanerInterface
{
  public function __construct(private bool $onlyPrintable = false)
  {
  }

  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    $options = $this->onlyPrintable ? FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH : FILTER_FLAG_STRIP_HIGH;
    assert(is_string($value));
    $result = filter_var($value, FILTER_UNSAFE_RAW, $options);
    assert(is_string($result));

    return $result;
  }
}
