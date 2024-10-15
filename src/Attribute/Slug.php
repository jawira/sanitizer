<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Cleaners;

use Attribute;
use Jawira\Sanitizer\Exceptions\FilterException;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Slug implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    is_string($value) ?: throw new FilterException('Slug value must be string.');
    assert(is_string($value)); // Tell Psalm $value is string

    $slugger = new AsciiSlugger();

    return $slugger->slug($value)->toString();
  }
}
