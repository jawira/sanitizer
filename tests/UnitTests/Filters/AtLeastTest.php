<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Cleaners\AtLeast;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(AtLeast::class)]
class AtLeastTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new AtLeast();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public static function checkProvider()
  {
    return [
      // false
      [123, false],
      [0, false],
      [1.1, false],
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
      [-1.1, true],
      [-0.0000001, true],
      [-500, true],
      [-5, true],
    ];
  }

  #[DataProvider('filterProvider')]
  public function testFilter($value = -5, $expected = 0)
  {
    $filter = new AtLeast();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      [-1, 0],
      [-1.5, 0],
      [-500_000, 0],
      [-500.321654, 0],
      [0, 0],
      [10, 10],
      [+1.5, 1.5],
    ];
  }

 #[DataProvider('filterWithNumberProvider')]
  public function testFilterWithNumber($value = -5, $number = 0, $expected = 0)
  {
    $filter = new AtLeast($number);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterWithNumberProvider()
  {
    return [
      // Value is selected
      [-1, -5, -1],
      [-1.5, -10, -1.5],
      [-500_000, -500_001, -500_000],
      [-500.321654, -500.6, -500.321654],
      [10, 0, 10],
      [5, 1, 5],
      [+2.5, 2, +2.5],
      // Number is selected
      [-1, 11, 11],
      [-1.5, 2.5, 2.5],
      [-500_000, -400_000, -400_000],
      [-500.321654, 0, 0],
      [0, 10, 10],
      [10, 10, 10],
      [+1.5, 2, 2],
    ];
  }
}
