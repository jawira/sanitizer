# AtLeast

AtLeast - Value is at least equal to provided number.

AtLeast only works with `int` and `float`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Motorcycle {
  #[Sanitizer\AtLeast(number: 2)]
  public int $wheels;
}
```

## Parameters

<dl>
<dt><em>int|float</em> <code>number</code> (optional):</dt>
<dd>
The property value will be compared against this number, if value is
<strong>less than</strong> provided number then this number will be used
instead.<br>
Default value is <em>0</em>.
</dd>
</dl>

## Examples

Value must be positive or zero.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Post {
  #[Sanitizer\AtLeast]
  public int $likes;
}
```

```php
0 → 0
10 → 10
-5 → 5
```

Value must be positive or zero.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Chemical {
  #[Sanitizer\AtLeast(number: -273.15)]
  public int|float $temperature;
}
```

```phpl
53  → 53
-100.50 → -100.50
-3000 → -273.15
```

## See also

[AtMost](AtMost.md) - Value is at most equal to provided number.
