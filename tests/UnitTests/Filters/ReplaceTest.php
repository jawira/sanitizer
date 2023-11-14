<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Cleaners\Replace;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Replace::class)]
class ReplaceTest extends TestCase
{

  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Replace('foo', 'bar');
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
      [" HELLO ", true],
      ["  HELLO   ", true],
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

  #[DataProvider('filterProvider')]
  public function testFilter($value, $expected)
  {
    $filter = new Replace(' ', '');
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['Hello World', 'HelloWorld'],
      ['   Hello World  ', 'HelloWorld'],
      ["\tHello World  ", "\tHelloWorld"],
      ["  bob@example.com   ", "bob@example.com"],
      ["bob  @   example.com", "bob@example.com"],
      [" bob @ example .com ", "bob@example.com"],
    ];
  }

  #[DataProvider('removeStringProvider')]
  public function testRemoveString($search, $value, $expected)
  {
    $filter = new Replace($search, '');
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function removeStringProvider()
  {
    return [
      ['Hello', 'Hello World. Hello Friend.', ' World.  Friend.'],
      ['world', 'Hello World', 'Hello World'],
      ['niño', 'Hola niño', 'Hola '],
      ['Único', 'Eres Único', 'Eres '],
      ['😷', 'Mood 😷', 'Mood '],
      ['Can', 'Can you open a can?', ' you open a can?'],
    ];
  }

  #[DataProvider('filterCustomProvider')]
  public function testFilterCustom($search, $replace, $value, $expected)
  {
    $filter = new Replace($search, $replace);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterCustomProvider()
  {
    return [
      ['World', 'Bob', 'Hello World', 'Hello Bob'],
      ['World', 'Bob', 'Hello World, Hi World', 'Hello Bob, Hi Bob'],
      ['world', 'Bob', 'Hello World', 'Hello World'],
      ['niño', 'nene', 'Hola niño', 'Hola nene'],
      ['Único', 'Única', 'Eres Único', 'Eres Única'],
      ['😷', '🤗', 'Mood 😷', 'Mood 🤗'],
      ['😷', '🤗', 'Mood 😷😷😷😷😷', 'Mood 🤗🤗🤗🤗🤗'],
      ['Can', 'Could', 'Can you open a can?', 'Could you open a can?'],
      ['Benjamín', 'José', "Benjamín pidió una bebida \nde kiwi y fresa.", "José pidió una bebida \nde kiwi y fresa."],
      ['JOSÉ', 'José', "Benjamín pidió una bebida \nde kiwi y fresa.", "Benjamín pidió una bebida \nde kiwi y fresa."],
    ];
  }

  #[DataProvider('removeStringInsensitiveProvider')]
  public function testRemoveStringInsensitive($search, $value, $expected)
  {
    $filter = new Replace($search, '', caseSensitive: false);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function removeStringInsensitiveProvider()
  {
    return [
      ['World', 'Hello World', 'Hello '],
      ['world', 'Hello World', 'Hello '],
      ['niño', 'Hola Niño', 'Hola '],
      ['Único', 'Eres ÚNICO', 'Eres '],
      ['😷', 'Mood 😷', 'Mood '],
      ['Can', 'Can you open a can?', ' you open a ?'],
      ['pidió', "El niño pidió una pizza\ny pidió una bebida.", "El niño  una pizza\ny  una bebida."],
    ];
  }

  #[DataProvider('filterCustomInsensitiveProvider')]
  public function testFilterCustomInsensitive($search, $replace, $value, $expected)
  {
    $filter = new Replace($search, $replace, caseSensitive: false);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterCustomInsensitiveProvider()
  {
    return [
      ['del toro', 'del Toro', 'Guillermo del Toro', 'Guillermo del Toro'],
      ['del toro', 'del Toro', 'Guillermo dEl tOrO', 'Guillermo del Toro'],
      ['del toro', 'del Toro', 'Guillermo DEL TORO', 'Guillermo del Toro'],
      ['World', 'Bob', 'Hello World', 'Hello Bob'],
      ['WORLD', 'Bob', 'Hello World', 'Hello Bob'],
      ['NIÑO', 'nene', 'Hola niño', 'Hola nene'],
      ['Único', 'Única', 'Eres único', 'Eres Única'],
      ['😷', '🤗', 'Mood 😷', 'Mood 🤗'],
      ['can', 'Could', 'Can you open a can?', 'Could you open a Could?'],
      ['PIDIÓ', 'compró', "El niño pidió una pizza\ny pidió una bebida.", "El niño compró una pizza\ny compró una bebida."],
    ];
  }
}
