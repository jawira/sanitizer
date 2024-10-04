<?php

namespace Dummies;

use Jawira\Sanitizer\Attribute as Filter;

class Car
{
  #[Filter\Trim]
  public string $constructor;

  #[Filter\Digits]
  public string $year;

  #[Filter\Absolute]
  public float $speed;

  #[Filter\AtLeast(0)]
  #[Filter\AtMost(130)]
  public float $odometer;
}
