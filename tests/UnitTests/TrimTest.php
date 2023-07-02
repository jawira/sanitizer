<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Trim;
use PHPUnit\Framework\TestCase;

class TrimTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Trim::check
   * @covers       \Jawira\Sanitizer\Filters\Trim::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Trim();
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
   * @covers       \Jawira\Sanitizer\Filters\Trim::filter
   * @covers       \Jawira\Sanitizer\Filters\Trim::__construct
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Trim();
    $result = $filter->filter($value);
    $this->assertSame($result, $expected);
  }

  public function filterProvider()
  {
    return [
      ['',''],
      ["\t",''],
      ['xxx','xxx'],
      ['123','123'],
      ['5e5','5e5'],
      ['Hello      ','Hello'],
      ['      Hello','Hello'],
      ['   Hello   ','Hello'],
    ];
  }
}