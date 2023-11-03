<?php

namespace UnitTests\Toolbox;

use Jawira\Sanitizer\Toolbox\MultiByte;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MultiByte::class)]
class MultiByteTest extends TestCase
{

  #[DataProvider('validFunctionsProvider')]
  public function testFunctionExists($value, $length, $padString, $padType, $expected)
  {
    $result = MultiByte::StringPad($value, $length, $padString, $padType);
    $this->assertSame($expected, $result);
  }

  public static function validFunctionsProvider()
  {
    return [
      ['John', 6, 'x', STR_PAD_BOTH, 'xJohnx'],
      ['Único', 7, '✅', STR_PAD_BOTH, '✅Único✅'],
      ['John', 6, 'x', STR_PAD_LEFT, 'xxJohn'],
      ['Único', 7, '✅', STR_PAD_LEFT, '✅✅Único'],
      ['John', 6, 'x', STR_PAD_RIGHT, 'Johnxx'],
      ['Único', 7, '✅', STR_PAD_RIGHT, 'Único✅✅'],
      ['No need of padding', 1, '*', STR_PAD_BOTH, 'No need of padding'],
    ];
  }

  #[DataProvider('exceptionsProvider')]
  public function testExceptions($value, $length, $padString, $padType, $encoding)
  {
    $message = null;
    try {
      $result = MultiByte::StringPad($value, $length, $padString, $padType, $encoding);
    } catch (\ValueError $error) {
      $message = $error->getMessage();
    }
    $this->assertIsString($message);
  }

  public static function exceptionsProvider()
  {
    return [
      'empty pad' => ['Hello', 6, '', STR_PAD_BOTH, 'UTF-8'],
      'wrong pad' => ['Hello', 1, 'x', 999, 'UTF-8'],
      'encoding' => ['Hello', 1, 'x', STR_PAD_BOTH, '%%%%%%%%'],
    ];
  }
}
