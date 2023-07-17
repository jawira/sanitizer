<?php

namespace Integration;

use Dummies\Currency;
use Jawira\Sanitizer\Sanitizer;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
  private Sanitizer $sanitizer;

  public function setUp(): void
  {
    $this->sanitizer = new Sanitizer();
  }

  /**
   * @dataProvider nameProvider
   * @covers       \Jawira\Sanitizer\Filters\Digits::precondition
   * @covers       \Jawira\Sanitizer\Filters\Digits::filter
   * @covers       \Jawira\Sanitizer\Filters\AtLeast::__construct
   * @covers       \Jawira\Sanitizer\Filters\AtLeast::precondition
   * @covers       \Jawira\Sanitizer\Filters\AtLeast::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @covers       \Jawira\Sanitizer\Filters\Pad::precondition
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Trim::__construct
   * @covers       \Jawira\Sanitizer\Filters\Trim::precondition
   * @covers       \Jawira\Sanitizer\Filters\Trim::filter
   * @covers       \Jawira\Sanitizer\Filters\Uppercase::precondition
   * @covers       \Jawira\Sanitizer\Filters\Uppercase::filter
   * @covers       \Jawira\Sanitizer\Sanitizer::applyFilter
   * @covers       \Jawira\Sanitizer\Sanitizer::sanitize
   * @covers       \Jawira\Sanitizer\Sanitizer::sanitizeProperty
   */
  public function testName($number, $numberExpected, $code, $codeExpected, $name, $nameExpected, $digits, $digitsExpected)
  {
    $currency = new Currency($number, $code, $name, $digits);
    $this->sanitizer->sanitize($currency);

    $this->assertSame($numberExpected, $currency->getNumber());
    $this->assertSame($codeExpected, $currency->getCode());
    $this->assertSame($nameExpected, $currency->getName());
    $this->assertSame($digitsExpected, $currency->getDigits());
  }

  public function nameProvider()
  {
    return [
      ['68', '068', "\tbob", 'BOB', '  Euro  ', 'Euro', 2, 2],
      ['987', '987', 'EUR', 'EUR', 'Euro', 'Euro', 2, 2],
      ['Code152', '152', 'Clp', 'CLP', ' Euro ', 'Euro', -5, 0],
    ];
  }
}
