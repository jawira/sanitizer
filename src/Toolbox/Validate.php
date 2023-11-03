<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Toolbox;

use Jawira\Sanitizer\FilterException;

class Validate
{
  public static function functionExists(string $functionName, string $message): void
  {
    if (!function_exists($functionName)) {
      throw new FilterException($message);
    }
  }

  public static function isString(mixed $value, string $message): void
  {
    if (!is_string($value)) {
      throw new FilterException($message);
    }
  }
}
