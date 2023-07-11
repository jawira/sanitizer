<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\EmptyStringToNull;
use PHPUnit\Framework\TestCase;

class EmptyStringToNullTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\EmptyStringToNull::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new EmptyStringToNull();
    $result = $filter->check($value);

    $this->assertSame($expected, $result);
  }

  public function checkProvider()
  {
    return [
      ['', true],
      ['a', false],
      [' ', false],
      ['hello-world', false],
      ['10e13', false],
      ['false', false],
      ['HELLO', false],
      ['Test', false],
      ["\t", false],
      [123, false],
      [1.1, false],
      [-123, false],
      [-1.1, false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\EmptyStringToNull::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new EmptyStringToNull();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      ['', null],
      ['0', '0'],
      ['-1', '-1'],
      ['Hello world', 'Hello world'],
    ];
  }
}
