<?php

namespace Integration;

use Dummies\Currency;
use Jawira\Sanitizer\Cleaners\AtLeast;
use Jawira\Sanitizer\Cleaners\Digits;
use Jawira\Sanitizer\Cleaners\Pad;
use Jawira\Sanitizer\Cleaners\Trim;
use Jawira\Sanitizer\Cleaners\Uppercase;
use Jawira\Sanitizer\Sanitizer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(AtLeast::class)]
#[CoversClass(Digits::class)]
#[CoversClass(Pad::class)]
#[CoversClass(Sanitizer::class)]
#[CoversClass(Trim::class)]
#[CoversClass(Uppercase::class)]
class CurrencyTest extends TestCase
{
  private Sanitizer $sanitizer;

  public function setUp(): void
  {
    $this->sanitizer = new Sanitizer();
  }

  #[DataProvider('nameProvider')]
  public function testName($number, $numberExpected, $code, $codeExpected, $name, $nameExpected, $digits, $digitsExpected)
  {
    $currency = new Currency($number, $code, $name, $digits);
    $this->sanitizer->sanitize($currency);

    $this->assertSame($numberExpected, $currency->getNumber());
    $this->assertSame($codeExpected, $currency->getCode());
    $this->assertSame($nameExpected, $currency->getName());
    $this->assertSame($digitsExpected, $currency->getDigits());
  }

  public static function nameProvider()
  {
    return [
      ['68', '068', "\tbob", 'BOB', '  Euro  ', 'Euro', 2, 2],
      ['987', '987', 'EUR', 'EUR', 'Euro', 'Euro', 2, 2],
      ['Code152', '152', 'Clp', 'CLP', ' Euro ', 'Euro', -5, 0],
    ];
  }
}
