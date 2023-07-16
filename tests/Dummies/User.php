<?php

namespace Dummies;

use Jawira\Sanitizer\Filters as Sanitizer;

class User
{
  #[Sanitizer\Trim]
  public string $name;

  #[Sanitizer\Trim]
  public string $lastName;

  #[Sanitizer\Ascii(onlyPrintable: true)]
  public string $phone;

  #[Sanitizer\AtLeast(0)]
  public int $age;

  public string $email;

  public string $countryCode;
}
