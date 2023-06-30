<?php declare(strict_types=1);

namespace Jawira\Sanitizer;
interface SanitizerInterface
{
  /**
   * Sanitize all properties in object.
   */
  public function sanitize(object $object): void;
}
