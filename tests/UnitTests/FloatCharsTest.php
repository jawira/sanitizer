<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\FloatChars;
use PHPUnit\Framework\TestCase;

class FloatCharsTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::check
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new FloatChars();
    $result = $filter->check($value);

    $this->assertSame($expected, $result);
  }

  public function checkProvider()
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

  /**
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::__construct
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::filter
   * @dataProvider filterProvider
   * @testdox      Integer filter sanitizes value $value as $expected
   */
  public function testFilter($value, $expected)
  {
    $filter = new FloatChars();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
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
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::__construct
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::filter
   * @dataProvider filterAllowThousandProvider
   * @testdox      Integer filter sanitizes value $value as $expected
   */
  public function testFilterAllowThousand($value, $expected)
  {
    $filter = new FloatChars(allowThousand: true);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterAllowThousandProvider()
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
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::__construct
   * @covers       \Jawira\Sanitizer\Filters\FloatChars::filter
   * @dataProvider filterAllowScientificProvider
   * @testdox      Integer filter sanitizes value $value as $expected
   */
  public function testFilterAllowScientific($value, $expected)
  {
    $filter = new FloatChars(allowScientific: true);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterAllowScientificProvider()
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
    ];
  }
}
