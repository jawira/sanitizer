# Absolute

Absolute - Absolute value.

Absolute only works with `int` and `float`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Travel {
  #[Sanitizer\Absolute]
  public int $km;
}
```

## Parameters

No parameters.

## Examples

Absolute value:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\Absolute]
  public int|float $age;
}
```

```php
10 → 10
-5 → 5
3.14 → 3.14
-1.5 → 1.5
```

## See also

-
