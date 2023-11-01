<?php

namespace Dummies;

use Jawira\Sanitizer\Enums\Side;
use Jawira\Sanitizer\Filters as Sanitizer;

/**
 * @see https://en.wikipedia.org/wiki/ISO_4217
 */
class Currency
{
  /**
   * Never initialized, used for testing purposes only.
   */
  private null|string $comments;

  public function __construct(
    #[Sanitizer\Digits]
    #[Sanitizer\Pad(length: 3, padString: '0', side: 'left')]
    private string $number,

    #[Sanitizer\Uppercase]
    #[Sanitizer\Trim]
    private string $code,

    #[Sanitizer\Trim(side: Side::Left)]
    #[Sanitizer\Trim(side: Side::Right)]
    private string $name,

    #[Sanitizer\AtLeast]
    private int $digits,
  )
  {
  }

  public function getNumber(): string
  {
    return $this->number;
  }

  public function getCode(): string
  {
    return $this->code;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getDigits(): int
  {
    return $this->digits;
  }
}
