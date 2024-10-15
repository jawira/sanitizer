<?php

namespace Dummies;

use Jawira\Sanitizer\Enums\Side;
use Jawira\Sanitizer\Attribute as Filter;

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
    #[Filter\Digits]
    #[Filter\Pad(length: 3, padString: '0', side: Side::Left)]
    private string $number,

    #[Filter\Uppercase]
    #[Filter\Trim]
    private string $code,

    #[Filter\Trim(side: Side::Left)]
    #[Filter\Trim(side: Side::Right)]
    private string $name,

    #[Filter\AtLeast]
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
