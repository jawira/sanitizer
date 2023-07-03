<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Pad;
use PHPUnit\Framework\TestCase;

class PadTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::check
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Pad('0');
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
      ["\t", true],
      [123, false],
      [1.1, false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider filterProvider
   */
  public function testFilter($value, $length, $padString, $expected)
  {
    $filter = new Pad($length, $padString, );
    $result = $filter->filter($value);
    $this->assertSame($result, $expected);
  }

  public function filterProvider()
  {
    return [
      ['', 0, '*', ''],
      ["\t", 3, ' ', "\t  "],
      ['xxx', 10, '-', 'xxx-------'],
      ['123', 8, 'azerty', '123azert'],
      ['5e5', 0, 'x', '5e5'],
      ['Hello      ', 10, 'x', 'Hello      '],
    ];
  }
}
