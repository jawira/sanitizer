<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\FloatChars;
use PHPUnit\Framework\TestCase;

class FloatCharsTest extends TestCase
{
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
      ['3.14', '3.14'],
      ['5e5', '55'],
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
}
