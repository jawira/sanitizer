<?php

namespace Dummies;

use Jawira\Sanitizer\Filters as Sanitizer;

class Travel
{
  #[Sanitizer\Abs]
  public float $distance;
}
