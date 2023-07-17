<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Substring implements FilterInterface
{
  public function __construct(private int  $length,
                              private bool $inBytes = false)
  {
  }

  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): mixed
  {
    /** @var callable-string $substring */
    $substring = $this->inBytes ? 'mb_strcut' : 'mb_substr'; // @todo use proper callable notation in PHP 8.1

    return $substring($value, 0, $this->length);
  }
}
