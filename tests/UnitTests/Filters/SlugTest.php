<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Filters\Pad;
use Jawira\Sanitizer\Filters\Slug;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Slug::class)]
class SlugTest extends TestCase
{

  #[DataProvider('checkProvider')]
  public function testCheck($value, $expected)
  {
    $filter = new Slug();
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

  #[DataProvider('slugProvider')]
  public function testSlug($value, $expected)
  {
    $filter = new Slug();

    $actual = $filter->filter($value);
    $this->assertSame($expected, $actual);
  }

  public static function slugProvider()
  {
    return [
      ['Moño', 'Mono'],
      ['Wôrķšƥáçè ~~sèťtïñğš~~', 'Workspace-settings'],
      ['お久しぶりですね', 'o-jiushiburidesune'],
      ['川', 'chuan'], // With japanese locale this is "kawa"
      ['나는 유리를', 'naneun-yulileul'],
      ['Я можу їсти шкло, й воно мені не пошкодить.', 'A-mozu-isti-sklo-j-vono-meni-ne-poskodit'],
      ['Happy Halloween 🎃', 'Happy-Halloween'],
      ['🍍 Piña Colada 🍍', 'Pina-Colada'],
      ['はい', 'hai'],
    ];
  }
}
