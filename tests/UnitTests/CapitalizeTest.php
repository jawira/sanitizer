<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Capitalize;
use Jawira\Sanitizer\Filters\Lowercase;
use PHPUnit\Framework\TestCase;

class CapitalizeTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Capitalize::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Capitalize();
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
      ["HELLO", true],
      ['Test', true],
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
   * @covers       \Jawira\Sanitizer\Filters\Capitalize::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Capitalize();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      ['', ''],
      ["\t", "\t"],
      ['xxx', 'Xxx'],
      ['123', '123'],
      ['3.14', '3.14'],
      ['5e5', '5E5'],
      ['Hello world', 'Hello World'],
      ['Hello World', 'Hello World'],
      ['hello world', 'Hello World'],
      ['heLLo worLd', 'Hello World'],
      ['HELLO WORLD', 'Hello World'],
      ['Γεια σας', 'Γεια Σας'],
    ];
  }
}
