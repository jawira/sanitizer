<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Slug implements FilterInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): mixed
  {
    $slugger = new AsciiSlugger();

    return $slugger->slug($value)->toString();
  }
}
