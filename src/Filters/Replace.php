<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use function is_string;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Replace implements FilterInterface
{
  private const DELIMITER = '#';

  public function __construct(private string $search,
                              private string $replace,
                              private bool   $caseSensitive = true)
  {
  }

  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): string
  {
    $modifiers = 'u';
    if (!$this->caseSensitive) {
      $modifiers .= 'i';
    }
    $search = preg_quote($this->search, self::DELIMITER);
    $pattern = sprintf('%s%s%s%s', self::DELIMITER, $search, self::DELIMITER, $modifiers);
    assert(is_string($value));

    return preg_replace($pattern, $this->replace, $value);
  }
}
