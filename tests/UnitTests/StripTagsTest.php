<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Pad;
use Jawira\Sanitizer\Filters\StripTags;
use PHPUnit\Framework\TestCase;

class StripTagsTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\StripTags::check
   * @covers       \Jawira\Sanitizer\Filters\StripTags::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new StripTags();
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
   * @covers       \Jawira\Sanitizer\Filters\StripTags::filter
   * @covers       \Jawira\Sanitizer\Filters\StripTags::__construct
   * @dataProvider filterProvider
   *
   */
  public function testFilter($value = 'Hello <b>world</b>', $allowedTags = [], $expected = 'Hello world')
  {
    $filter = new StripTags($allowedTags);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public function filterProvider()
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
    ];
  }
}
