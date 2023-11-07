<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Filters\Ascii;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Ascii::class)]
class AsciiTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Ascii();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public static function checkProvider()
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

  #[DataProvider('filterProvider')]

  public function testFilter($value, $onlyPrintable, $expected)
  {
    $filter = new Ascii($onlyPrintable);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', false, ''],
      ["\t", false, "\t"],
      ["\r\n", false, "\r\n"],
      ["\u{01}A\u{10}B\u{30}C", false, "\u{01}A\u{10}B\u{30}C"],
      ["\t", true, ""],
      ["Foo\nBar", false, "Foo\nBar"],
      ["\r\n", true, ""],
      ["Hello\r\nfriend", true, "Hellofriend"],
      ["Hello\r\nfriend", false, "Hello\r\nfriend"],
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
      ['1-BRÚ-016', false, '1-BR-016'],
    ];
  }

}
