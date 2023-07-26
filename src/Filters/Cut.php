<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Cut implements FilterInterface
{
  public function __construct(private int  $length,
                              private bool $useBytes = false)
  {
  }

  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): mixed
  {
    $start = 0;
    $length = $this->length;

    if ($this->length < 0) {
      $start = $this->length;
      $length = null;
    }

    /** @var callable-string $substring */
    $substring = $this->useBytes ? 'mb_strcut' : 'mb_substr'; // @todo use proper callable notation in PHP 8.1

    return $substring($value, $start, $length);
  }
}
