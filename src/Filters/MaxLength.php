<?php
/** @noinspection PhpComposerExtensionStubsInspection */
declare(strict_types=1);


namespace Jawira\Sanitizer\Filters;

use Attribute;
use Jawira\Sanitizer\Enums\StringMode;
use Jawira\Sanitizer\FilterException;
use function grapheme_substr;
use function is_string;
use function mb_strcut;
use function mb_substr;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class MaxLength implements FilterInterface
{
  public function __construct(private readonly int        $length,
                              private readonly StringMode $stringMode = StringMode::Characters)
  {
  }

  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  public function filter(mixed $value): mixed
  {
    if (!is_string($value)) {
      throw new FilterException('Value must be string.');
    }

    $start = 0;
    $length = $this->length;

    // If length is negative cut string from the end.
    if ($this->length < 0) {
      $start = $this->length;
      $length = null;
    }

    return match ($this->stringMode) {
      StringMode::Bytes => $this->lengthInBytes($value, $start, $length),
      StringMode::Characters => $this->lengthInCharacters($value, $start, $length),
      StringMode::Graphemes => $this->lengthInGraphemes($value, $start, $length),
    };
  }

  private function lengthInBytes(string $value, int $start, ?int $length): string
  {
    if (!function_exists('mb_strcut')) {
      throw new FilterException('mb_strcut function required, install mbstring extension.');
    }

    return mb_strcut($value, $start, $length);
  }

  private function lengthInCharacters(string $value, int $start, ?int $length): string
  {
    if (!function_exists('mb_substr')) {
      throw new FilterException('mb_substr function required, install mbstring extension.');
    }

    return mb_substr($value, $start, $length);
  }

  private function lengthInGraphemes(string $value, int $start, ?int $length): string
  {
    if (!function_exists('grapheme_substr')) {
      throw new FilterException('grapheme_substr function required, install intl extension.');
    }

    return grapheme_substr($value, $start, $length);
  }
}