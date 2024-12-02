<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Attribute;

use Attribute;
use Jawira\Sanitizer\Exceptions\FilterException;
use Transliterator;
use function assert;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Slug implements CleanerInterface
{
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * @see https://unicode-org.github.io/icu/userguide/
   */
  public function filter(mixed $value): string
  {
    is_string($value) ?: throw new FilterException('Slug value must be string.');
    assert(is_string($value)); // Tell Psalm $value is string

    $rules = ':: Any-Latin; :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC; :: [^-[:^Punctuation:]] Remove; :: Lower(); [:^L:] { [-] > ; [-] } [:^L:] > ; [-[:Separator:]]+ > ' - ';';

    return \Transliterator::createFromRules($rules)->transliterate($value);
  }
}
