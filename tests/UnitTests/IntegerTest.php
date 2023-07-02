<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Integer::check
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Integer();
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
   * @covers       \Jawira\Sanitizer\Filters\Integer::filter
   * @dataProvider filterProvider
   * @testdox Integer filter sanitizes value $value as $expected
   */
  public function testFilter($value, $expected)
  {
    $filter = new Integer();
    $result = $filter->filter($value);

    $this->assertSame($result, $expected);
  }

  public function filterProvider()
  {
    return [
      ['',''],
      ["\t",""],
      ['xxx',''],
      ['032','032'],
      ['+24','+24'],
      ['++032','++032'],
      ['--032','--032'],
      ['-64 with text','-64'],
      ['00032','00032'],
      ['000003200000','000003200000'],
      ['123','123'],
      ['3.14','314'],
      ['5e5','55'],
      ['Hello      ',''],
      ['      Hello',''],
      ['   Hello   ',''],
      ['Γεια σας',''],
      ['H3ll0','30'],
    ];
  }
}