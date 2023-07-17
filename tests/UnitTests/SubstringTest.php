<?php

namespace UnitTests;

use Jawira\Sanitizer\Filters\Substring;
use PHPUnit\Framework\TestCase;

class SubstringTest extends TestCase
{

  /**
   * @covers       \Jawira\Sanitizer\Filters\Substring::check
   * @covers       \Jawira\Sanitizer\Filters\Substring::__construct
   * @dataProvider checkProvider
   */
  public function testCheck($value, $expected)
  {
    $filter = new Substring(0);
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
      [new \stdClass(), false],
    ];
  }
  /**
   * @covers       \Jawira\Sanitizer\Filters\Substring::__construct
   * @covers       \Jawira\Sanitizer\Filters\Substring::filter
   * @dataProvider filterProvider
   */
  public function testFilter($value, $length, $expected)
  {
    $filter = new Substring($length);
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
      ['Hello world!', -8, 'Hell'],
      ['Elephpant', -50, ''],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -24, 'Կրնամ ապակի ուտել'],
    ];
  }


  /**
   * @covers       \Jawira\Sanitizer\Filters\Substring::__construct
   * @covers       \Jawira\Sanitizer\Filters\Substring::filter
   * @dataProvider filterInBytesProvider
   */
  public function testFilterInBytes($value, $length, $expected)
  {
    $filter = new Substring($length, inBytes: true);
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
      ['Hello world!', -8, 'Hell'],
      ['Elephpant', -50, ''],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -44, 'Կրնամ ապակի ուտել'],
    ];
  }

}
