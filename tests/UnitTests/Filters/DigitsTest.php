<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Attribute\Digits;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Digits::class)]
class DigitsTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Digits();
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
      [-123, false],
      [-1.1, false],
      [0, false],
      [null, false],
      [true, false],
      [false, false],
      [array(), false],
    ];
  }

  #[DataProvider('filterProvider')]
  public function testFilter($value = '10 AM', $expected = '10')
  {
    $filter = new Digits();
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    $longText = <<<TEXT
    Lorem ipsum dolor 123 sit amet, 24 consectetur adipiscing elit.
    Ego vero isti, inquam, permitto 500.
    Philosophi autem in suis lectulis 88 plerumque moriuntur.
    TEXT;

    return [
      ['10 AM', '10'],
      ['Hello', ''],
      ['H3ll0', '30'],
      ['101.15', '10115'],
      ['-101.15', '10115'],
      ['-253', '253'],
      ['5e5', '55'],
      ['-5e5', '55'],
      ["500\n300", '500300'],
      ['', ''],
      ["\t", ''],
      ["13\t14", '1314'],
      ['xxx', ''],
      ['032', '032'],
      ['+24', '24'],
      ['032', '032'],
      ['++032', '032'],
      ['--032', '032'],
      ['-64 with text', '64'],
      ['00032', '00032'],
      ['000003200000', '000003200000'],
      ['123', '123'],
      ['124,123.00', '12412300'],
      ['3.14', '314'],
      ['5e5', '55'],
      ['5E5', '55'],
      ['-123', '123'],
      ['-3.14', '314'],
      ['-5e5', '55'],
      ['Hello      ', ''],
      ['      Hello', ''],
      ['   Hello   ', ''],
      ['Γεια σας', ''],
      [$longText, '1232450088'],
    ];
  }
}
