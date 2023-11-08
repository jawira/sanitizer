<?php

namespace Dummies;

use Jawira\Sanitizer\Filters as Sanitizer;

class Car
{
  public function __construct(
    #[Sanitizer\Slug]
    #[Sanitizer\Lowercase]
    public string $code,

    #[Sanitizer\Trim]
    public string $brand,

    #[Sanitizer\Digits]
    public string $year,

    #[Sanitizer\Absolute]
    public float  $speed,

    #[Sanitizer\AtLeast(0)]
    #[Sanitizer\AtMost(130)]
    public float  $odometer,
  )
  {
  }
}
