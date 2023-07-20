# AtMost

AtMost - Value is at most equal to provided number.

AtMost only works with `int` and `float`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Exam {
  #[Sanitizer\AtMost(number: 100)]
  public string $grade;
}
```

## Parameters

<dl>
<dt><em>int|float</em> <code>number</code> (optional):</dt>
<dd>
The property value will be compared against this number, if value is
<strong>greater than</strong> provided number then this number will be used
instead.<br>
Default value is <em>0</em>.
</dd>
</dl>

## Examples

Value must be negative or zero.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Submarine {
  #[Sanitizer\AtMost]
  public int|float $depth;
}
```

```php
50 → 0
36 → 0
10 → 0
-5 → -5
-500.45 → -500.45
```

Value cannot be greater than 20.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Building {
  #[Sanitizer\AtMost(number: 20)]
  public int $levels;
}
```

```php
50 → 20
36 → 20
10 → 10
0 → 0
-2 → -2
```

## See also

[AtLeast](AtLeast.md) - Value is at least equal to provided number.
