<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Cleaners\StripTags;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(StripTags::class)]
class StripTagsTest extends TestCase
{

  #[DataProvider('checkProvider')]

  public function testCheck($value, $expected)
  {
    $filter = new StripTags();
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
  public function testFilter($value = 'Hello <b>world</b>', $allowedTags = [], $expected = 'Hello world')
  {
    $filter = new StripTags($allowedTags);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['Abc', [], 'Abc'],
      ['123', [], '123'],
      ['Hello <b>world</b>', [], 'Hello world'],
      ['5 < 10', [], '5 < 10'],
      ['<p>James<br>Bond</p>', [], 'JamesBond'],
      ['<p>James<br>Bond</p>', ['br'], 'James<br>Bond'],
      ['<p>James<br>Bond</p>', ['p'], '<p>JamesBond</p>'],
      ['<p>James<br>Bond</p>', ['p', 'br'], '<p>James<br>Bond</p>'],
      ['Hello <!-- comment --> World', [], 'Hello  World'],
      ['<p>Hello <strong>John</strong></p>', [], 'Hello John'],
      ['<p>Hello <strong>John</strong></p>', ['p', 'br'], '<p>Hello John</p>'],
    ];
  }
}
