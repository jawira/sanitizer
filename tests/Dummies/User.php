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

  #[Sanitizer\GteZero]
  public string $age;

  public string $email;

  public string $countryCode;
}
