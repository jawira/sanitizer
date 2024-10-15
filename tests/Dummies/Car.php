<?php

namespace Dummies;

use Jawira\Sanitizer\Attribute as Filter;

class Car
{
  #[Filter\Slug]
  public string $code;

  #[Filter\Trim]
  public string $brand;

  #[Filter\Digits]
  public string $year;

  #[Filter\Absolute]
  public float $speed;

  #[Filter\AtLeast(0)]
  #[Filter\AtMost(130)]
  public float $odometer;

  public function __construct(string $code, string $brand, string $year, float $speed, float $odometer)
  {
    $this->code = $code;
    $this->brand = $brand;
    $this->year = $year;
    $this->speed = $speed;
    $this->odometer = $odometer;
  }
}
