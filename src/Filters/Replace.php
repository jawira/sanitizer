<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function assert;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Replace implements FilterInterface
{
  public function __construct(private string $search = ' ',
                              private string $replace = '',
                              private bool   $insensitive = false)
  {
  }

  public function check(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    /** @var callable-string $replace */
    $replace = $this->insensitive ? 'str_ireplace' : 'str_replace';

    $newValue = $replace($this->search, $this->replace, $value);
    assert(is_string($newValue));

    return $newValue;
  }
}
