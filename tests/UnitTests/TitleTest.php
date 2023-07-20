<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Title::precondition
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Title();
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
   * @covers       \Jawira\Sanitizer\Filters\Title::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $expected)
  {
    $filter = new Title();
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
      ['foo   bar   baz', 'Foo   Bar   Baz'],
      [' need4speed ', ' Need4Speed '],
      ["   FOO\tBAR   ", "   Foo\tBar   "],
      ["foo\nbar", "Foo\nBar"],
      ['Hello world', 'Hello World'],
      ['Hello World', 'Hello World'],
      ['hello world', 'Hello World'],
      ['heLLo worLd', 'Hello World'],
      ['HELLO WORLD', 'Hello World'],
      ['Γεια σας', 'Γεια Σας'],
      ['prêt-à-porter', 'Prêt-À-Porter'],
      ['Loin, très loin, au delà des monts Mots.', 'Loin, Très Loin, Au Delà Des Monts Mots.'],
    ];
  }
}
