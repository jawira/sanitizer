<?php

namespace Test\Demos;

use Jawira\Sanitizer\Filters as Sanitizer;

class TrimPrivate
{
  #[Sanitizer\Trim]
  private string $name;

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

}
