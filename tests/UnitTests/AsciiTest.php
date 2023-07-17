<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Ascii;
use PHPUnit\Framework\TestCase;

class AsciiTest extends TestCase
{
  /**
   * @dataProvider checkProvider
   * @covers       \Jawira\Sanitizer\Filters\Ascii::__construct
   * @covers       \Jawira\Sanitizer\Filters\Ascii::precondition
   */
  public function testCheck($value, $expected)
  {
    $filter = new Ascii();
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
      ['Û', true],
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
   * @dataProvider filterProvider
   * @covers       \Jawira\Sanitizer\Filters\Ascii::filter
   * @covers       \Jawira\Sanitizer\Filters\Ascii::__construct
   */
  public function testFilter($value, $onlyPrintable, $expected)
  {
    $filter = new Ascii($onlyPrintable);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      ['', false, ''],
      ["\t", false, "\t"],
      ["\r\n", false, "\r\n"],
      ["\u{01}A\u{10}B\u{30}C", false, "\u{01}A\u{10}B\u{30}C"],
      ["\t", true, ""],
      ["\r\n", true, ""],
      ["A\u{00}B\u{06}C\u{20}A\u{1A}B\u{1C}C\u{1F}", true, "ABC ABC"],
      ['Elephpant🐘', false, 'Elephpant'],
      ['xxx', false, 'xxx'],
      ['032', false, '032'],
      ['--032', false, '--032'],
      ['-64 with text', true, '-64 with text'],
      ['123', true, '123'],
      ['3.14', true, '3.14'],
      ['Γεια σας', true, ' '],
      ['H3ll0', true, 'H3ll0'],
      ['Árbol', true, 'rbol'],
    ];
  }

}
