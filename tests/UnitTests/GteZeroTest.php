<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\GteZero;
use PHPUnit\Framework\TestCase;

class GteZeroTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\GteZero::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new GteZero();
    $result = $filter->check($value);

    $this->assertSame($expected, $result);
  }

  public function checkProvider()
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


  /**
   * @covers       \Jawira\Sanitizer\Filters\GteZero::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value = -5, $expected = 0)
  {
    $filter = new GteZero();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
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
}
