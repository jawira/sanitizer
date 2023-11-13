<?php

namespace Dummies;

use Jawira\Sanitizer\Cleaners as Filter;

class User
{
  #[Filter\Trim]
  public string $name;

  #[Filter\Trim]
  public string $lastName;

  #[Filter\Ascii(onlyPrintable: true)]
  public string $phone;

  #[Filter\AtLeast(0)]
  public int $age;

  public string $email;

  public string $countryCode;
}
