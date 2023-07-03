<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

#[\Attribute]
class StripTags implements FilterInterface
{
  public function __construct(
    /** @var string[] */
    private array $allowedTags = []
  )
  {
  }

  public function check(mixed $propertyValue): bool
  {
    return is_string($propertyValue);
  }

  public function filter(mixed $propertyValue): string
  {
    assert(is_string($propertyValue));

    return strip_tags($propertyValue, $this->allowedTags);
  }
}
