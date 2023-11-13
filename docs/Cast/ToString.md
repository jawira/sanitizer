# ToString

ToString - Casts value to _string_.

ToString only works with `null`, `bool`, `int`, `float`, `array`, any other type
is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Sanitizer;

class User {
  #[Sanitizer\ToString]
  public string $name;
}
```

## Parameters

No parameters.

## Examples

Cast value to string.

```php
use Jawira\Sanitizer\Cleaners as Sanitizer;

class Car {
  #[Sanitizer\ToString]
  public $description;
}
```

```php
null → ""
true → "1"
false → ""
456 → "456"
3.14 → "3.14"
```

## See also

[ToInt](ToInt.md) - Casts value to _integer_.
