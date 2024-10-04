# ToString

ToString - Casts value to _string_.

ToString only works with `null`, `bool`, `int`, `float`, `array`, any other type
is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Attribute as Filter;

class User {
  #[Filter\ToString]
  public string $name;
}
```

## Parameters

No parameters.

## Examples

Cast value to string.

```php
use Jawira\Sanitizer\Attribute as Filter;

class Car {
  #[Filter\ToString]
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
