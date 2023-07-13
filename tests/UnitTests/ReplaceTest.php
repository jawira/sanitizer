<?php

namespace UnitTests;


use Jawira\Sanitizer\Filters\Replace;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Replace();
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
  /**
   * @dataProvider filterProvider
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::filter
   */
  public function testFilter($value, $expected)
  {
    $filter = new Replace();
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterProvider()
  {
    return [
      ['Hello World', 'HelloWorld'],
      ['   Hello World  ', 'HelloWorld'],
      ["\tHello World  ", "\tHelloWorld"],
    ];
  }

  /**
   * @dataProvider removeStringProvider
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::filter
   */
  public function testRemoveString($search, $value, $expected)
  {
    $filter = new Replace($search);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function removeStringProvider()
  {
    return [
      ['World', 'Hello World', 'Hello '],
      ['world', 'Hello World', 'Hello World'],
      ['niño', 'Hola niño', 'Hola '],
      ['Único', 'Eres Único', 'Eres '],
      ['😷', 'Mood 😷', 'Mood '],
      ['Can', 'Can you open a can?', ' you open a can?'],
    ];
  }

  /**
   * @dataProvider filterCustomProvider
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::filter
   */
  public function testFilterCustom($search, $replace, $value, $expected)
  {
    $filter = new Replace($search, $replace);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterCustomProvider()
  {
    return [
      ['World', 'Bob', 'Hello World', 'Hello Bob'],
      ['world', 'Bob', 'Hello World', 'Hello World'],
      ['niño', 'nene', 'Hola niño', 'Hola nene'],
      ['Único', 'Única', 'Eres Único', 'Eres Única'],
      ['😷', '🤗', 'Mood 😷', 'Mood 🤗'],
      ['Can', 'Could', 'Can you open a can?', 'Could you open a can?'],
    ];
  }

  /**
   * @dataProvider removeStringInsensitiveProvider
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::filter
   */
  public function testRemoveStringInsensitive($search, $value, $expected)
  {
    $filter = new Replace($search, insensitive: true);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function removeStringInsensitiveProvider()
  {
    return [
      ['World', 'Hello World', 'Hello '],
      ['world', 'Hello World', 'Hello '],
      ['niño', 'Hola niño', 'Hola '],
      ['Único', 'Eres Único', 'Eres '],
      ['😷', 'Mood 😷', 'Mood '],
      ['Can', 'Can you open a can?', ' you open a ?'],
    ];
  }

  /**
   * @dataProvider filterCustomInsensitiveProvider
   * @covers       \Jawira\Sanitizer\Filters\Replace::__construct
   * @covers       \Jawira\Sanitizer\Filters\Replace::filter
   */
  public function testFilterCustomInsensitive($search, $replace, $value, $expected)
  {
    $filter = new Replace($search, $replace, insensitive: true);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterCustomInsensitiveProvider()
  {
    return [
      ['World', 'Bob', 'Hello World', 'Hello Bob'],
      ['world', 'Bob', 'Hello World', 'Hello Bob'],
      ['niño', 'nene', 'Hola niño', 'Hola nene'],
      ['Único', 'Única', 'Eres Único', 'Eres Única'],
      ['😷', '🤗', 'Mood 😷', 'Mood 🤗'],
      ['Can', 'Could', 'Can you open a can?', 'Could you open a Could?'],
    ];
  }
}
