# ToInt

ToInt - Returns the integer value.

Empty arrays return _0_, non-empty arrays return _1_.

ToInt only works with `null`, `bool`, `float`, `string`, `array`, any other type
is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\ToInt]
  public int|string $age;
}
```

## Parameters

<dl>
<dt><em>int</em> <code>base</code> (optional):</dt>
<dd>
Sets the base, only used when value is <em>string</em>.<br>
Default value is <em>10</em>.
</dd>
</dl>

## Examples

Cast value to integer.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Product {
  #[Sanitizer\ToInt]
  public $comments;
}
```

```php
null → 0
true → 1
false → 0
450 → 450
8.0 → 8
8.1 → 8
"15" → 15
"-15" → -15
"70.99" → 70
"-70.99" → -70
"5e3" → 5000
[] → 0
['foo', 'bar'] → 1
```

Cast binary string to integer.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Product {
  #[Sanitizer\ToInt(base: 2)]
  public ;
}
```

```php
"10011" → 19
"0b10011" → 19
```

## See also


