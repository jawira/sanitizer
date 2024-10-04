<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Attribute\AtMost;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(AtMost::class)]
class AtMostTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new AtMost();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public static function checkProvider()
  {
    return [
      // false
      [-123, false],
      [0, false],
      [-1.1, false],
      ['', false],
      ["10e13", false],
      ["false", false],
      ['Test', false],
      ["\t", false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
      // true
      [1.1, true],
      [0.0000001, true],
      [500, true],
      [5, true],
    ];
  }

  #[DataProvider('filterProvider')]
  public function testFilter($value, $expected)
  {
    $filter = new AtMost();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      [1, 0],
      [1.5, 0],
      [500_000, 0],
      [500.321654, 0],
      [0, 0],
      [-1, -1],
      [-1.5, -1.5],
      [-500_000, -500_000],
      [-500.321654, -500.321654],
    ];
  }

  #[DataProvider('filterWithNumberProvider')]
  public function testFilterWithNumber($value = -5, $number = 0, $expected = 0)
  {
    $filter = new AtMost($number);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterWithNumberProvider()
  {
    return [
      // Number is selected
      [-1, -5, -5],
      [-1.5, -10, -10],
      [-500_000, -500_001, -500_001],
      [-500.321654, -500.6, -500.6],
      [10, 0, 0],
      [5, 1, 1],
      [+2.5, 2, 2],
      // Value is selected
      [-1, 11, -1],
      [-1.5, 2.5, -1.5],
      [-500_000, -400_000, -500_000],
      [-500.321654, 0, -500.321654],
      [0, 10, 0],
      [10, 10, 10],
      [+1.5, 2, +1.5],
    ];
  }
}
