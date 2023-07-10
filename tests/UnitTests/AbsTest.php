<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Abs;
use PHPUnit\Framework\TestCase;

class AbsTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Abs::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Abs;
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
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
