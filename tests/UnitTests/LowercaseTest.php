<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Lowercase;
use PHPUnit\Framework\TestCase;

class LowercaseTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Lowercase::precondition
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Lowercase();
    $result = $filter->precondition($value);

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
   * @covers       \Jawira\Sanitizer\Filters\Lowercase::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Lowercase();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      ['',''],
      ["\t","\t"],
      ['xxx','xxx'],
      ['123','123'],
      ['3.14','3.14'],
      ['5e5','5e5'],
      ['Hello      ','hello      '],
      ['      Hello','      hello'],
      ['   Hello   ','   hello   '],
      ['Γεια σας','γεια σας'],
      ['Австралия','австралия'],
    ];
  }
}
