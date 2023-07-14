<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\ToInt;
use PHPUnit\Framework\TestCase;

class ToIntTest extends TestCase
{
  /**
   * @dataProvider filterProvider
   * @covers       \Jawira\Sanitizer\Filters\ToInt::__construct
   * @covers       \Jawira\Sanitizer\Filters\ToInt::filter
   */
  public function testFilter($value, $expected)
  {
    $filter = new ToInt();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      [null, 0],
      [false, 0],
      [true, 1],
      [8.0, 8],
      [8.1, 8],
      [-80.1, -80],
      [-80.1, -80],
      ['', 0],
      ['1Way', 1],
      ['noWay', 0],
      ['013', 13],
      ['+013', 13],
      ['-013', -13],
      ['1e10', 10_000_000_000],
      ['0x1A', 0],
      [420000000000000000000, -4275113695319687168], // big value is stored 4.2E+20, hence it's considered double.
      ['420000000000000000000', 9223372036854775807],
      [[], 0],
      [['foo'], 1],
    ];
  }

  /**
   * @dataProvider filterWithBaseProvider
   * @covers       \Jawira\Sanitizer\Filters\ToInt::__construct
   * @covers       \Jawira\Sanitizer\Filters\ToInt::filter
   */
  public function testFilterWithBase($value, $base, $expected)
  {
    $filter = new ToInt($base);
    $result = $filter->filter($value);

    $this->assertIsInt($result);
    $this->assertSame($expected, $result);
  }

  public function filterWithBaseProvider()
  {
    return [
      // No strings, base has no effect
      [null, 2, 0],
      [false, 2, 0],
      [true, 2, 1],
      [8.0, 2, 8],
      [8.1, 2, 8],
      [-80.1, 2, -80],
      [-80.1, 2, -80],
      [420000000000000000000, 2, -4275113695319687168], // big value is stored 4.2E+20, hence it's considered double.
      [[], 2, 0],
      [['foo'], 2, 1],
      // Base only works with strings
      ['', 8, 0],
      ['1Way', 8, 1],
      ['noWay', 8, 0],
      ['013', 8, 11],
      ['+013', 8, 11],
      ['-013', 8, -11],
      ['1e10', 10, 10_000_000_000],
      ['0x1A', 10, 0],
      ['0x1A', 16, 26],
      ['420000000000000000000', 10, 9223372036854775807],
      // Auto-mode
      ['', 0, 0],
      ['1Way', 0, 1],
      ['noWay', 0, 0],
      ['013', 0, 11],
      ['+013', 0, 11],
      ['-013', 0, -11],
      ['1e10', 0, 1], // auto mode disables scientific
      ['0x1A', 0, 26],
      ['420000000000000000000', 0, 9223372036854775807],
    ];
  }
}
