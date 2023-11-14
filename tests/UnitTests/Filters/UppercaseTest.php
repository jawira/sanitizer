<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Cleaners\Uppercase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Uppercase::class)]
class UppercaseTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Uppercase();
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
    $filter = new Uppercase();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', ''],
      ["\t", "\t"],
      ['xxx', 'XXX'],
      ['123', '123'],
      ['3.14', '3.14'],
      ['5e5', '5E5'],
      ['Hello      ', 'HELLO      '],
      ['      Hello', '      HELLO'],
      ['   Hello   ', '   HELLO   '],
      ['Γεια σας', 'ΓΕΙΑ ΣΑΣ'],
      ['prêt-à-porter', 'PRÊT-À-PORTER'],
    ];
  }
}
