<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Enums\LengthMode;
use Jawira\Sanitizer\Attribute\MaxLength;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @see https://www.kermitproject.org/utf8.html
 */
#[CoversClass(MaxLength::class)]
class MaxLengthTest extends TestCase
{

  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new MaxLength(0);
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
      [new \stdClass(), false],
    ];
  }

  #[DataProvider('bytesProvider')]
  public function testFilterWithBytes($value, $length, $expected)
  {
    $filter = new MaxLength(length: $length, mode: LengthMode::Bytes);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function bytesProvider()
  {
    return [
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -10, 'ըներ։'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", 10, 'Կրնամ'],
      ['', 10, ''],
      ['', -10, ''],
      ['AAA', 0, ''],
      ['Café', -4, 'afé'],
      ['Café', 4, 'Caf'],
      ['Elephpant', -50, 'Elephpant'],
      ['Elephpant', 50, 'Elephpant'],
      ['Foo Bar Baz', -3, 'Baz'],
      ['Foo Bar Baz', 3, 'Foo'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', -6, 'amón.'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', 6, 'Quiere'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', -500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', 500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', -3, 'ᛗ'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', 3, 'ᚠ'],
      ['お久しぶりですね', -4, 'すね'],
      ['お久しぶりですね', 4, 'お'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', -15, '프지 않아요'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', 15, '나는 유리'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', -5, '🇧🇪'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', 5, '🇧'],
      ['🎃🎃👻🎃🎃', -3, '🎃'],
      ['🎃🎃👻🎃🎃', 3, ''],
    ];
  }

  #[DataProvider('characterProvider')]
  public function testFilterWithCharacter($value, $length, $expected)
  {
    $filter = new MaxLength(length: $length, mode: LengthMode::Characters);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function characterProvider()
  {
    return [
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -10, 'իստ չըներ։'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", 10, 'Կրնամ ապակ'],
      ['', 10, ''],
      ['', -10, ''],
      ['AAA', 0, ''],
      ['Café', -4, 'Café'],
      ['Café', 4, 'Café'],
      ['Elephpant', -50, 'Elephpant'],
      ['Elephpant', 50, 'Elephpant'],
      ['Foo Bar Baz', -3, 'Baz'],
      ['Foo Bar Baz', 3, 'Foo'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', -6, 'jamón.'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', 6, 'Quiere'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', -500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', 500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', -3, 'ᚳᚢᛗ'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', 3, 'ᚠᛇᚻ'],
      ['お久しぶりですね', -4, 'りですね'],
      ['お久しぶりですね', 4, 'お久しぶ'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', -15, '어요. 그래도 아프지 않아요'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', 15, '나는 유리를 먹을 수 있어요'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', -5, '🇪🇧🇪🇧🇪'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', 5, '🇧🇪🇧🇪🇧'],
      ['🎃🎃👻🎃🎃', -3, '👻🎃🎃'],
      ['🎃🎃👻🎃🎃', 3, '🎃🎃👻'],
    ];
  }

  #[DataProvider('graphemeProvider')]
  public function testFilterWithGrapheme($value, $length, $expected)
  {
    $filter = new MaxLength(length: $length, mode: LengthMode::Graphemes);
    $result = $filter->filter($value);

    $this->assertSame($expected, $result);
  }

  public static function graphemeProvider()
  {
    return [
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", -10, 'իստ չըներ։'],
      ["Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։", 10, 'Կրնամ ապակ'],
      ['', 10, ''],
      ['', -10, ''],
      ['AAA', 0, ''],
      ['Café', -4, 'Café'],
      ['Café', 4, 'Café'],
      ['Elephpant', -50, 'Elephpant'],
      ['Elephpant', 50, 'Elephpant'],
      ['Foo Bar Baz', -3, 'Baz'],
      ['Foo Bar Baz', 3, 'Foo'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', -6, 'jamón.'],
      ['Quiere la boca exhausta vid, kiwi, piña y fugaz jamón.', 6, 'Quiere'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', -500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', 500, 'Я можу їсти шкло, й воно мені не пошкодить.'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', -3, 'ᚳᚢᛗ'],
      ['ᚠᛇᚻ᛫ᛒᛦᚦ᛫ᚠᚱᚩᚠᚢᚱ᛫ᚠᛁᚱᚪ᛫ᚷᛖᚻᚹᛦᛚᚳᚢᛗ', 3, 'ᚠᛇᚻ'],
      ['お久しぶりですね', -4, 'りですね'],
      ['お久しぶりですね', 4, 'お久しぶ'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', -15, '어요. 그래도 아프지 않아요'],
      ['나는 유리를 먹을 수 있어요. 그래도 아프지 않아요', 15, '나는 유리를 먹을 수 있어요'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', -5, '🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪'],
      ['🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪', 5, '🇧🇪🇧🇪🇧🇪🇧🇪🇧🇪'],
      ['🎃🎃👻🎃🎃', -3, '👻🎃🎃'],
      ['🎃🎃👻🎃🎃', 3, '🎃🎃👻'],
    ];
  }
}
