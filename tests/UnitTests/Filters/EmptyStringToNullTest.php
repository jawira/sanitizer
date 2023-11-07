<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Filters\EmptyStringToNull;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(EmptyStringToNull::class)]
class EmptyStringToNullTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new EmptyStringToNull();
    $result = $filter->precondition($value);

    $this->assertSame($expected, $result);
  }

  public static function checkProvider()
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

  #[DataProvider('filterProvider')]
  public function testFilter($value, $expected)
  {
    $filter = new EmptyStringToNull();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', null],
      ['0', '0'],
      ['-1', '-1'],
      ['Hello world', 'Hello world'],
    ];
  }
}
