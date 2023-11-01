<?php

namespace Dummies;

use Jawira\Sanitizer\Filters as Sanitizer;

class Car
{
  #[Sanitizer\Trim]
  public string $constructor;

  #[Sanitizer\Digits]
  public string $year;

  #[Sanitizer\Absolute]
  public float $speed;

  #[Sanitizer\AtLeast(0)]
  #[Sanitizer\AtMost(130)]
  public float $odometer;
}
