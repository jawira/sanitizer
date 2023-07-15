<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_string;
use function strip_tags;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class StripTags implements FilterInterface
{
  public function __construct(
    /** @var string[] */
    private array $allowedTags = []
  ) {
  }

  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    assert(is_string($value));

    /** @psalm-suppress InvalidArgument */
    return strip_tags($value, $this->allowedTags);
  }
}
