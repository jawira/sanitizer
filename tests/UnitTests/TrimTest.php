<?php

namespace UnitTests;

use Jawira\Sanitizer\Enums\Side;
use Jawira\Sanitizer\Filters\Trim;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Trim::class)]
class TrimTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Trim();
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
      ["\t", true],
      [123, false],
      [1.1, false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
      [new \stdClass(), false],
    ];
  }

  #[DataProvider('filterProvider')]
  public function testFilter($value, $direction, $expected)
  {
    $filter = new Trim(side: $direction);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', Side::Both, ''],
      ["\t", Side::Both, ''],
      ["\r\n", Side::Both, ''],
      ['xxx', Side::Both, 'xxx'],
      ['123', Side::Both, '123'],
      ['5e5', Side::Both, '5e5'],
      ['      Hello', Side::Both, 'Hello'],
      ['   Hello   ', Side::Both, 'Hello'],
      ['Hello      ', Side::Both, 'Hello'],
      ['      Hello', Side::Left, 'Hello'],
      ['   Hello   ', Side::Left, 'Hello   '],
      ['Hello      ', Side::Left, 'Hello      '],
      ['      Hello', Side::Right, '      Hello'],
      ['   Hello   ', Side::Right, '   Hello'],
      ['Hello      ', Side::Right, 'Hello'],
    ];
  }
}
