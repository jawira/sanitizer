# ToInt

ToInt - Casts value to _integer_.

Empty arrays return _0_, non-empty arrays return _1_.

ToInt only works with `null`, `bool`, `float`, `string`, `array`, any other type
is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Sanitizer;

class User {
  #[Sanitizer\ToInt]
  public int|string $age;
}
```

## Parameters

<dl>
<dt><em>int</em> <code>base</code> (optional):</dt>
<dd>
<p>Sets the base, only used when value is <em>string</em>.</p>
<p>When the base is set to <em>0</em>, the base is determined by string prefix.<br>
If the string starts with:</p>
<ul>
<li><code>0b</code> or <code>0B</code> the base is <em>2</em>.</li>
<li><code>0x</code> or <code>0X</code> the base is <em>16</em>.</li>
<li><code>0</code> the base is <em>8</em>.</li>
</ul>
<p> Default value is <em>10</em>.</p>
</dd>
</dl>

## Examples

Cast value to integer.

```php
use Jawira\Sanitizer\Cleaners as Sanitizer;

class Product {
  #[Sanitizer\ToInt]
  public $quantity;
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
use Jawira\Sanitizer\Cleaners as Sanitizer;

class Product {
  #[Sanitizer\ToInt(base: 2)]
  public $quantity;
}
```

```php
"10011" → 19
"0b10011" → 19
```

Detect string base.

```php
use Jawira\Sanitizer\Cleaners as Sanitizer;

class Product {
  #[Sanitizer\ToInt(base: 0)]
  public $quantity;
}
```

```php
"0b10011" → 19
"0x1A" → 26
"077" → 63
```

## See also

[ToString](ToString.md) - Casts value to _string_.
