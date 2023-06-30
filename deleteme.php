<?php

use Jawira\Sanitizer\Filters as Sanitizer;

require_once __DIR__ . '/vendor/autoload.php';

class Dummy
{
  #[Sanitizer\Trim]
  public $name = 'Mike';

  #[Sanitizer\Trim]
  public string $lastName;
}

$demo = new Dummy();
$demo->name = "  Junior\t";
echo $demo->name, PHP_EOL;

$service = new \Jawira\Sanitizer\SanitizerService();
$service->sanitize($demo);

echo $demo->name, PHP_EOL;
