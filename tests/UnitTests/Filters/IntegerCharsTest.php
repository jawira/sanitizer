<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Attribute\IntegerChars;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(IntegerChars::class)]
class IntegerCharsTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new IntegerChars();
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
    $filter = new IntegerChars();
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
      ['3.14', '314'],
      ['-3.14', '-314'],
      ['5e5', '55'],
      ['Hello      ', ''],
      ['      Hello', ''],
      ['   Hello   ', ''],
      ['Γεια σας', ''],
      ['H3ll0', '30'],
    ];
  }
}
