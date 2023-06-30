<?php

namespace Tests\Demos;

use Jawira\Sanitizer\Filters as Sanitizer;

class TrimPublic
{
  #[Sanitizer\Trim]
  public $name;
}
