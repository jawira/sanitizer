<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Attribute\FloatChars;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(FloatChars::class)]
class FloatCharsTest extends TestCase
{

  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new FloatChars();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public static function checkProvider()
  {
    return [
      ['', true],
      ['a', true],
      [' ', true],
      ["hello-world", true],
      ["10e13", true],
      ["false", true],
      ["HELLO", true],
      ['Test', true],
      ['Û', true],
      ["\t", true],
      [123, false],
      [1.1, false],
      [-123, false],
      [-1.1, false],
      [0, false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
    ];
  }

  #[DataProvider('filterProvider')]
  public function testFilter($value, $expected)
  {
    $filter = new FloatChars();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', ''],
      ["\t", ""],
      ['xxx', ''],
      ['032', '032'],
      ['+24', '+24'],
      ['++032', '++032'],
      ['--032', '--032'],
      ['-64 with text', '-64'],
      ['00032', '00032'],
      ['000003200000', '000003200000'],
      ['123', '123'],
      ['124,123.00', '124123.00'],
      ['3.14', '3.14'],
      ['5e5', '55'],
      ['5E5', '55'],
      ['-123', '-123'],
      ['-3.14', '-3.14'],
      ['-5e5', '-55'],
      ['Hello      ', ''],
      ['      Hello', ''],
      ['   Hello   ', ''],
      ['Γεια σας', ''],
      ['H3ll0', '30'],
      ['-654-.-546-', '-654-.-546-'],
    ];
  }

  #[DataProvider('filterAllowThousandProvider')]
  public function testFilterAllowThousand($value, $expected)
  {
    $filter = new FloatChars(allowThousand: true);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterAllowThousandProvider()
  {
    return [
      ['', ''],
      ["\t", ""],
      ['xxx', ''],
      ['032', '032'],
      ['+24', '+24'],
      ['++032', '++032'],
      ['--032', '--032'],
      ['-64 with text', '-64'],
      ['00032', '00032'],
      ['000003200000', '000003200000'],
      ['123', '123'],
      ['124,123.00', '124,123.00'],
      ['3.14', '3.14'],
      ['5e5', '55'],
      ['5E5', '55'],
      ['-123', '-123'],
      ['-3.14', '-3.14'],
      ['-5e5', '-55'],
      ['Hello      ', ''],
      ['      Hello', ''],
      ['   Hello   ', ''],
      ['Γεια σας', ''],
      ['H3ll0', '30'],
      ['437.50F', '437.50'],
      ['-64,.,56-', '-64,.,56-'],
    ];
  }

  #[DataProvider('filterAllowScientificProvider')]
  public function testFilterAllowScientific($value, $expected)
  {
    $filter = new FloatChars(allowScientific: true);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterAllowScientificProvider()
  {
    return [
      ['', ''],
      ["\t", ""],
      ['xxx', ''],
      ['032', '032'],
      ['+24', '+24'],
      ['++032', '++032'],
      ['--032', '--032'],
      ['-64 with text', '-64e'],
      ['00032', '00032'],
      ['000003200000', '000003200000'],
      ['123', '123'],
      ['124,123.00', '124123.00'],
      ['3.14', '3.14'],
      ['5e5', '5e5'],
      ['5E5', '5E5'],
      ['-123', '-123'],
      ['-3.14', '-3.14'],
      ['-5e5', '-5e5'],
      ['Hello      ', 'e'],
      ['      Hello', 'e'],
      ['   Hello   ', 'e'],
      ['Γεια σας', ''],
      ['H3ll0', '30'],
      ['Foo 33 Bar', '33'],
      ['-+E123...', '-+E123...'],
    ];
  }
}
