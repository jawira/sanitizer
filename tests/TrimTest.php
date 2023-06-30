<?php declare(strict_types=1);

namespace Tests;

use Jawira\Sanitizer\SanitizerService;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jawira\Sanitizer\Filters\Trim
 */
final class TrimTest extends TestCase
{
  private SanitizerService $sanitizer;

  public function setUp(): void
  {
    $this->sanitizer = new SanitizerService();
  }

  /**
   * @dataProvider trimProvider
   * @covers \Jawira\Sanitizer\Filters\Trim
   * @testdox Value $name is sanitized as $expected with Trim
   */
  public function testTrimDefault($name, $expected): void
  {
    $trim = new Demos\TrimPublic();
    $trim->name = $name;
    $this->sanitizer->sanitize($trim);

    $this->assertSame($expected, $trim->name);
  }

  /**
   * @dataProvider trimProvider
   * @covers \Jawira\Sanitizer\Filters\Trim
   * @testdox Value $name is sanitized as $expected with Trim
   */
  public function testTrimPrivate($name, $expected): void
  {
    $trim = new Demos\TrimPrivate();
    $trim->setName($name);
    $this->sanitizer->sanitize($trim);

    $this->assertSame($expected, $trim->getName());
  }

  public function trimProvider()
  {
    return [
      ['', ''],
      ['John', 'John'],
      [" \tJohn\t ", 'John'],
      ["John\t\t\t", 'John'],
      ["John      ", 'John'],
      ["      John", 'John'],
      ["   John   ", 'John'],
    ];
  }

}

