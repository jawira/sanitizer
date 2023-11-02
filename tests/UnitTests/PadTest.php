<?php declare(strict_types=1);

namespace UnitTests;

use Jawira\Sanitizer\Enums\Side;
use Jawira\Sanitizer\Filters\Pad;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Pad::class)]
class PadTest extends TestCase
{
  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Pad(0);
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
  public function testFilter($value, $length, $expected)
  {
    $filter = new Pad(length: $length);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterProvider()
  {
    return [
      ['', 0, ''],
      ["\t", 3, "\t  "],
      ['xxx', 10, 'xxx       '],
      ['123', 8, '123     '],
      ['5e5', 0, '5e5'],
      ['Hello      ', 10, 'Hello      '],
    ];
  }

  #[DataProvider('filterWithPadStringProvider')]
  public function testFilterWithPadString($value, $length, $padString, $expected)
  {
    $filter = new Pad(length: $length, padString: $padString,);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterWithPadStringProvider()
  {
    return [
      ['', 0, '*', ''],
      ["\t", 3, ' ', "\t  "],
      ['xxx', 10, '-', 'xxx-------'],
      ['123', 8, 'azerty', '123azert'],
      ['5e5', 0, 'x', '5e5'],
      ['Hello      ', 10, 'x', 'Hello      '],
      ['four thousand', 30, '*', 'four thousand*****************'],
      ['one thousand five hundred', 30, '*', 'one thousand five hundred*****'],
      ['Fire', 5, '🔥', 'Fire🔥'],
    ];
  }

  #[DataProvider('filterWithSideProvider')]
  public function testFilterWithSide($value, $length, $side, $expected)
  {
    $filter = new Pad(length: $length, side: $side);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterWithSideProvider()
  {
    return [
      // both
      ['', 0, Side::Both, ''],
      ["\t", 3, Side::Both, " \t "],
      ['xxx', 10, Side::Both, '   xxx    '],
      ['123', 8, Side::Both, '  123   '],
      ['5e5', 0, Side::Both, '5e5'],
      ['Hello', 10, Side::Both, '  Hello   '],
      ['Piña', 6, Side::Both, ' Piña '],
      ['🍍', 3, Side::Both, ' 🍍 '],
      // left
      ['', 0, Side::Left, ''],
      ["\t", 3, Side::Left, "  \t"],
      ['xxx', 10, Side::Left, '       xxx'],
      ['123', 8, Side::Left, '     123'],
      ['5e5', 0, Side::Left, '5e5'],
      ['Hello', 10, Side::Left, '     Hello'],
      ['Piña', 6, Side::Left, '  Piña'],
      ['🍍', 3, Side::Left, '  🍍'],
      // right
      ['', 0, Side::Right, ''],
      ["\t", 3, Side::Right, "\t  "],
      ['xxx', 10, Side::Right, 'xxx       '],
      ['123', 8, Side::Right, '123     '],
      ['5e5', 0, Side::Right, '5e5'],
      ['Hello', 10, Side::Right, 'Hello     '],
      ['Piña', 6, Side::Right, 'Piña  '],
      ['🍍', 3, Side::Right, '🍍  '],
    ];
  }


  #[DataProvider('filterWithAllOptionsProvider')]
  public function testFilterWithAllOptions($value, $length, $padString, $side, $expected)
  {
    $filter = new Pad(length: $length, padString: $padString, side: $side);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public static function filterWithAllOptionsProvider()
  {
    return [
      ['', 0, '*', Side::Left, ''],
      ["\t", 3, ' ', Side::Right, "\t  "],
      ['123', 8, 'azerty', Side::Left, 'azert123'],
      ['68', 3, '0', Side::Left, '068'],
      ['5e5', 0, 'x', Side::Both, '5e5'],
      ['Hello      ', 10, 'x', Side::Right, 'Hello      '],
      ['CREDITS', 30, '-+-', Side::Both, '-+--+--+--+CREDITS-+--+--+--+-'],
      ['DOCUMENTATION', 30, '-+-', Side::Both, '-+--+--+DOCUMENTATION-+--+--+-'],
      ['AUTHOR', 30, '-+-', Side::Both, '-+--+--+--+-AUTHOR-+--+--+--+-'],
      ['Piña', 6, '🍍', Side::Right, 'Piña🍍🍍'],
      ['Piña', 6, '🍍', Side::Left, '🍍🍍Piña'],
      ['Piña', 6, '🍍', Side::Both, '🍍Piña🍍'],
    ];
  }

}
