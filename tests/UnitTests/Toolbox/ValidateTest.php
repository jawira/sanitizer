<?php

namespace UnitTests\Toolbox;

use Jawira\Sanitizer\FilterException;
use Jawira\Sanitizer\Toolbox\Validate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\TestCase;

#[CoversClass(Validate::class)]
class ValidateTest extends TestCase
{

  #[DataProvider('validFunctionsProvider')]
  #[DoesNotPerformAssertions]
  public function testFunctionExists($value)
  {
    Validate::functionExists($value, '');
  }

  public static function validFunctionsProvider()
  {
    return [
      ['sprintf'],
      ['strlen'],
    ];
  }

  #[DataProvider('invalidFunctionsProvider')]
  public function testFunctionDoNotExist($functionName, $expectedMessage, $expectedClass)
  {
    try {
      Validate::functionExists($functionName, $expectedMessage);
    } catch (FilterException $exception) {
      $message = $exception->getMessage();
      $class = get_class($exception);
    }
    $this->assertSame($expectedMessage, $message);
    $this->assertSame($expectedClass, $class);
  }

  public static function invalidFunctionsProvider()
  {
    return [
      ['hana_dul', 'hana_dul function no not exists', 'Jawira\Sanitizer\FilterException'],
      ['my_invalid', 'my_invalid function no not exists', 'Jawira\Sanitizer\FilterException'],
    ];
  }

  #[DataProvider('isStringProvider')]
  #[DoesNotPerformAssertions]
  public function testIsString($value)
  {
    Validate::isString($value, '');
  }

  public static function isStringProvider()
  {
    return [
      ['qsdf'],
      ['10'],
    ];
  }

  #[DataProvider('isNotStringProvider')]
  public function testIsNotString($value, $expectedMessage, $expectedClass)
  {
    try {
      Validate::isString($value, $expectedMessage);
    } catch (FilterException $exception) {
      $message = $exception->getMessage();
      $class = get_class($exception);
    }
    $this->assertSame($expectedMessage, $message);
    $this->assertSame($expectedClass, $class);
  }

  public static function isNotStringProvider()
  {
    return [
      [132, 'This is an int', 'Jawira\Sanitizer\FilterException'],
      [false, 'This is boolean', 'Jawira\Sanitizer\FilterException'],
      [1.25, 'This is float', 'Jawira\Sanitizer\FilterException'],
      [['hello'], 'Not a string', 'Jawira\Sanitizer\FilterException'],
    ];
  }
}
