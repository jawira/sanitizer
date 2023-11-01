<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Absolute;
use PHPUnit\Framework\TestCase;

class AbsTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\Absolute::precondition
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Absolute();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public function checkProvider()
  {
    return [
      // true
      [123, true],
      [1.1, true],
      [-123, true],
      [-1.1, true],
      [0, true],
      [10E3, true],
      [-10e3, true],
      // false
      ['a', false],
      [' ', false],
      ['13', false],
      ["hello-world", false],
      ["10e13", false],
      ["false", false],
      ["HELLO", false],
      ['Test', false],
      ['Û', false],
      ["\t", false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
    ];
  }


  /**
   * @covers       \Jawira\Sanitizer\Filters\Absolute::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Absolute;
    $result = $filter->filter($value);

    $this->asserftSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      [0, 0],
      [+0, 0],
      [-0, 0],
      [100, 100],
      [-100, 100],
      [5000, 5000],
      [-5000, 5000],
      [123_550_800, 123550800],
      [-123_550_800, 123550800],
      [100.321, 100.321],
      [-100.321, 100.321],
      [5000.321, 5000.321],
      [-5000.321, 5000.321],
      [12e-5, 0.00012],
      [-12e-5, 0.00012],
      [700E-2, 7.0],
      [-700E-2, 7.0],
      [1_234.567, 1_234.567],
      [-1_234.567, 1_234.567],
    ];
  }
}
