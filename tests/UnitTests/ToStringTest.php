<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\ToString;
use PHPUnit\Framework\TestCase;

class ToStringTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\ToString::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new ToString();
    $result = $filter->check($value);

    $this->assertSame($expected, $result);
  }

  public function checkProvider()
  {
    $car = new class {
      public function __toString()
      {
        return 'My super CAR';
      }
    };

    return [
      ['', false],
      ['a', false],
      [' ', false],
      ["hello-world", false],
      ["10e13", false],
      ["false", false],
      ["\t", false],
      [123, true],
      [1.1, true],
      [null, true],
      [true, true],
      [false, true],
      [array(), false],
      [new \stdClass(), false],
      [$car, true],
    ];
  }

  /**
   * @dataProvider filterProvider
   * @covers       \Jawira\Sanitizer\Filters\ToString::filter
   */
  public function testFilter($value, $expected)
  {
    $filter = new ToString();
    $result = $filter->filter($value);

    $this->assertIsString($result);
    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    $television = new class {
      public function __toString()
      {
        return 'My super TV';
      }
    };

    return [
      [null, ''],
      [true, '1'],
      [false, ''],
      [456, '456'],
      [+456, '456'],
      [-456, '-456'],
      [3.14, '3.14'],
      [-3.14, '-3.14'],
      [3e3, '3000'],
      [3e3, '3000'],
      [$television, 'My super TV'],
    ];
  }
}
