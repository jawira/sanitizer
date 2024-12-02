<?php

namespace UnitTests\Filters;

use Jawira\Sanitizer\Attribute\Slug;
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
  public function testSlug(string $value, string $expected)
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
      ['Æ', 'AE'],

      // Basic Cases
      ['Hello World!', 'hello-world'],
      ['PHP Unit Test', 'php-unit-test'],
      ['Simple Slug', 'simple-slug'],
      ['Multiple    Spaces', 'multiple-spaces'],
      ['Hello---World', 'hello-world'],
      ['Leading Space ', 'leading-space'],
      ['Trailing Space ', 'trailing-space'],
      ['  Extra  Spaces  ', 'extra-spaces'],

      // Special Characters
      ['Café au Lait!', 'cafe-au-lait'],
      ['Pâté de Foie Gras!', 'pate-de-foie-gras'],
      ['façade', 'facade'],
      ['Über cool!', 'uber-cool'],
      ['Crème Brûlée!', 'creme-brulee'],
      ['München', 'munchen'],

      // Non-Latin Characters
      ['你好', 'ni-hao'], // Chinese
      ['Привет мир', 'privet-mir'], // Russian
      ['こんにちは', 'kon-ni-chi-wa'], // Japanese
      ['さようなら', 'sayo-nara'], // Goodbye in Japanese
      ['ありがとう', 'arigatou'], // Thank you in Japanese
      ['привет', 'privet'], // Hi in Russian
      ['мир', 'mir'], // World in Russian
      ['какой замечательный день', 'kakoy-zamechatelnyy-den'], // What a wonderful day

      // Multiple Punctuation
      ['Hello!!!', 'hello'],
      ['Hello... World?', 'hello-world'],
      ['PHP: The Right Way', 'php-the-right-way'],
      ['...Oops...', 'oops'],

      // Only Special Characters
      ['!!!@@@###', ''],
      ['@#$%^&*()', ''],
      ['~~~~~~~~~', ''],

      // Complex Cases
      ['My 1st Blog Post!', 'my-1st-blog-post'],
      ['Test: 1234 & Example', 'test-1234-example'],
      ['Space  &  &  Hyphens -- Everywhere', 'space-hyphens-everywhere'],
      ['URL: http://example.com', 'url-http-example-com'],
      ['User: John_Doe', 'user-john-doe'],

      // Edge Cases
      ['', ''],
      ['   ', ''],
      ['     !@#$%^   ', ''],
      ['---', ''],
      ['   Leading and trailing spaces!   ', 'leading-and-trailing-spaces'],
      ['Multiple---Consecutive---Hyphens', 'multiple-consecutive-hyphens'],
      ['A---B---C---D', 'a-b-c-d'],
      ['This is a test! #1', 'this-is-a-test-1'],
      ['Testing special chars @ # $ % &', 'testing-special-chars'],
      ['Testing (parentheses)', 'testing-parentheses'],
      ['Testing [brackets]', 'testing-brackets'],
      ['Testing {braces}', 'testing-braces'],
      ['Hello _ underscore', 'hello-underscore'],

      // Variations
      ['Say Hello, World!', 'say-hello-world'],
      ['Is this working?', 'is-this-working'],
      ['Mix of 1, 2, 3 and A, B, C', 'mix-of-1-2-3-and-a-b-c'],
      ['Hello, how are you?', 'hello-how-are-you'],
      ['Good morning! Have a great day.', 'good-morning-have-a-great-day'],
      ['Test, test, testing', 'test-test-testing'],
      ['Best Practices for 2024!', 'best-practices-for-2024'],
      ['Fun & Games', 'fun-games'],
      ['Using (Parentheses)', 'using-parentheses'],
      ['Long URL: http://example.com/test-page', 'long-url-http-example-com-test-page'],
      ['Mix of different symbols @#!$', 'mix-of-different-symbols'],
      ['123 Test Cases', '123-test-cases'],
      ['Slugify THIS!!!', 'slugify-this'],
      ['Extra  -    Spaces   -   Here', 'extra-spaces-here'],
      ['Properly: Capitalized Slug', 'properly-capitalized-slug'],
    ];
  }
}
