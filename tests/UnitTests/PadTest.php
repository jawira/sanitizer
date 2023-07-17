<?php declare(strict_types=1);

namespace UnitTests;

use Jawira\Sanitizer\Filters\Pad;
use PHPUnit\Framework\TestCase;

class PadTest extends TestCase
{
  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::precondition
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Pad(0);
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
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider filterProvider
   */
  public function testFilter($value, $length, $expected)
  {
    $filter = new Pad(length: $length);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterProvider()
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

  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider filterWithPadStringProvider
   */
  public function testFilterWithPadString($value, $length, $padString, $expected)
  {
    $filter = new Pad(length: $length, padString: $padString,);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterWithPadStringProvider()
  {
    return [
      ['', 0, '*', ''],
      ["\t", 3, ' ', "\t  "],
      ['xxx', 10, '-', 'xxx-------'],
      ['123', 8, 'azerty', '123azert'],
      ['5e5', 0, 'x', '5e5'],
      ['Hello      ', 10, 'x', 'Hello      '],
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider filterWithSideProvider
   */
  public function testFilterWithSide($value, $length, $side, $expected)
  {
    $filter = new Pad(length: $length, side: $side);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterWithSideProvider()
  {
    return [
      // both
      ['', 0, Pad::BOTH, ''],
      ["\t", 3, Pad::BOTH, " \t "],
      ['xxx', 10, Pad::BOTH, '   xxx    '],
      ['123', 8, Pad::BOTH, '  123   '],
      ['5e5', 0, Pad::BOTH, '5e5'],
      ['Hello', 10, Pad::BOTH, '  Hello   '],
      // left
      ['', 0, Pad::LEFT, ''],
      ["\t", 3, Pad::LEFT, "  \t"],
      ['xxx', 10, Pad::LEFT, '       xxx'],
      ['123', 8, Pad::LEFT, '     123'],
      ['5e5', 0, Pad::LEFT, '5e5'],
      ['Hello', 10, Pad::LEFT, '     Hello'],
      // right
      ['', 0, Pad::RIGHT, ''],
      ["\t", 3, Pad::RIGHT, "\t  "],
      ['xxx', 10, Pad::RIGHT, 'xxx       '],
      ['123', 8, Pad::RIGHT, '123     '],
      ['5e5', 0, Pad::RIGHT, '5e5'],
      ['Hello', 10, Pad::RIGHT, 'Hello     '],
    ];
  }


  /**
   * @covers       \Jawira\Sanitizer\Filters\Pad::filter
   * @covers       \Jawira\Sanitizer\Filters\Pad::__construct
   * @dataProvider filterWithAllOptionsProvider
   */
  public function testFilterWithAllOptions($value, $length, $padString, $side, $expected)
  {
    $filter = new Pad(length: $length, padString: $padString, side: $side);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function filterWithAllOptionsProvider()
  {
    return [
      ['', 0, '*', 'left', ''],
      ["\t", 3, ' ', 'right', "\t  "],
      ['123', 8, 'azerty', 'left', 'azert123'],
      ['68', 3, '0', 'left', '068'],
      ['5e5', 0, 'x', 'both', '5e5'],
      ['Hello      ', 10, 'x', 'right', 'Hello      '],
    ];
  }

  /**
   * @coversNothing
   */
  public function testNewFunction()
  {
    $exists = function_exists('mb_str_pad');
    /**
     * @link https://wiki.php.net/rfc/mb_str_pad
     */
    $this->assertFalse($exists, 'Update filter with mb_str_pad!!');
  }
}

