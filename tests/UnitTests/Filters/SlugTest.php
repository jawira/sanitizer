<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Filters\Slug;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Slug::class)]
class SlugTest extends TestCase
{
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
    ];
  }
}
