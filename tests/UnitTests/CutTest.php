<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Cut;
use PHPUnit\Framework\TestCase;

class CutTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\Cut::precondition
   * @covers       \Jawira\Sanitizer\Filters\Cut::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Cut(0);
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
      [new \stdClass(), false],
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\Cut::__construct
   * @covers       \Jawira\Sanitizer\Filters\Cut::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $length, $expected)
  {
    $filter = new Cut(length: $length);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  /**
   * @see https://www.kermitproject.org/utf8.html
   */
  public function filterProvider()
  {
    return [
      // Positive length
      ['Hello world!', 4, 'Hell'],
      ['Elephpant', 50, 'Elephpant'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", 17, 'Կրնամ ապակի ուտել'],
      // Negative length
      ['Hello world!', -6, 'world!'],
      ['Elephpant', -50, 'Elephpant'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -24, ' և ինծի անհանգիստ չըներ։'],
      ['CPU-486', 5, 'CPU-4'],
      ['しょうぼうし', 5, 'しょうぼう'],
      ['CPU-486', -3, '486'],
      ['しょうぼうし', -3, 'ぼうし'],
    ];
  }


  /**
   * @covers       \Jawira\Sanitizer\Filters\Cut::__construct
   * @covers       \Jawira\Sanitizer\Filters\Cut::filter
   * @dataProvider filterInBytesProvider
   */
  public function testFilterInBytes($value, $length, $expected)
  {
    $filter = new Cut(length: $length, useBytes: true);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  /**
   * @see https://www.kermitproject.org/utf8.html
   */
  public function filterInBytesProvider()
  {
    return [
      // Positive length
      ['Hello world!', 4, 'Hell'],
      ['Elephpant', 50, 'Elephpant'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", 32, 'Կրնամ ապակի ուտել'],
      // Negative length
      ['Hello world!', -6, 'world!'],
      ['Elephpant', -50, 'Elephpant'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -23, 'նգիստ չըներ։'],
    ];
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\Cut::__construct
   * @covers       \Jawira\Sanitizer\Filters\Cut::filter
   * @dataProvider withStartProvider
   */
  public function testWithStart($length, $useBytes, $value, $expected)
  {
    // Parameters in order
    $filter = new Cut($length, $useBytes);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  /**
   * @covers       \Jawira\Sanitizer\Filters\Cut::__construct
   * @covers       \Jawira\Sanitizer\Filters\Cut::filter
   * @dataProvider withStartProvider
   */
  public function testWithStartAndNamedParameters($length, $useBytes, $value, $expected)
  {
    // Parameters in order
    $filter = new Cut(length: $length, useBytes: $useBytes);
    $result = $filter->filter($value);
    $this->assertSame($expected, $result);
  }

  public function withStartProvider()
  {
    return [
      [4, false, 'Hello world', 'Hell'],
      [-3, false, 'Foo Bar Baz', 'Baz'],
      [0, false, 'Foo Bar Baz', ''],
      [-6, false, 'Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', 'jamón.'],
      [4, false, 'お久しぶりですね', 'お久しぶ'],
      [-4, false, 'お久しぶりですね', 'りですね'],
      [8, false, 'お久しぶりですね', 'お久しぶりですね'],
      [8, true, 'お久しぶりですね', 'お久'],
      [4, false, 'Café', 'Café'],
      [4, true, 'Café', 'Caf'],
      [-2, true, 'Café', 'é'],
    ];
  }
}
