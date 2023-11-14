<?php

namespace Integration;

use Dummies\Car;
use Jawira\Sanitizer\Filters\Absolute;
use Jawira\Sanitizer\Filters\AtLeast;
use Jawira\Sanitizer\Filters\AtMost;
use Jawira\Sanitizer\Filters\Digits;
use Jawira\Sanitizer\Filters\Lowercase;
use Jawira\Sanitizer\Filters\Slug;
use Jawira\Sanitizer\Filters\Trim;
use Jawira\Sanitizer\Sanitizer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;


#[CoversClass(Car::class)]
#[CoversClass(Absolute::class)]
#[CoversClass(AtLeast::class)]
#[CoversClass(AtMost::class)]
#[CoversClass(Digits::class)]
#[CoversClass(Lowercase::class)]
#[CoversClass(Slug::class)]
#[CoversClass(Trim::class)]
#[CoversClass(Sanitizer::class)]
class CarTest extends TestCase
{
  private Sanitizer $sanitizer;

  public function setUp(): void
  {
    $this->sanitizer = new Sanitizer();
  }

  #[DataProvider('carProvider')]
  public function testCar($code, $codeExpected, $brand, $brandExpected, $year, $yearExpected, $speed, $speedExpected, $odometer, $odometerExpected)
  {
    $car = new Car($code, $brand, $year, $speed, $odometer);
    $this->sanitizer->sanitize($car);
    $this->assertSame($codeExpected, $car->code);
  }

  public static function carProvider(): array
  {
    return [
      ['ABC 456', 'abc-456', ' Renault  ', 'Renault', 'Year 2020', '2020', -10, 10, -5, 0],
      [' X4S4d4', 'x4s4d4', 'Tata  ', 'Tata', 'y2023', '2023', 100.50, 100.50, 180, 130],
      ['ù%µXC', 'u-xc', '   Dacia', 'Dacia', ' 2016 ', '2016', -500_000, 500_000, 50, 50],
    ];
  }
}
