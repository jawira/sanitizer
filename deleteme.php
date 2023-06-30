<?php

require_once __DIR__ . '/vendor/autoload.php';

use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\SanitizerService;

class Demo
{
  #[Sanitizer\Lowercase]
  #[Sanitizer\Trim]
  public $country = '   Fr  ';
}

$x = new Demo;

$sanitizer = new SanitizerService();
$sanitizer->sanitize($x) ;

var_dump($x);
