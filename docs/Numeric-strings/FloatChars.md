# FloatChars

FloatChars - Remove all characters except `0-9`, `+`, `-`, `.` and
optionally `,`, `e`, and `E`.

FloatChars does not verify if a string is a well-formed float string, it only
verifies that all characters belong to a certain character set.<br>
Therefore, even if it's counterintuitive, FloatChars will leave the following
strings unmodified:

* "13"
* "-50.3"
* "+-456...789"

FloatChars only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
  #[Filter\FloatChars]
  public string $height;
}
```

## Parameters

<dl>
<dt><em>bool</em> <code>allowThousand</code> (optional):</dt>
<dd>
Allow a thousand separator character <code>,</code>.<br>
Default value is <em>false</em>.
</dd>
<dt><em>bool</em> <code>allowScientific</code> (optional):</dt>
<dd>
Allow scientific notation characters <code>eE</code>.<br>
Default value is <em>false</em>.
</dd>
</dl>

## Examples

Only allow `0-9`, `+`, `-` and `.` characters.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Car {
  #[Filter\FloatChars]
  public string $odometer;
}
```

```php
"152"     → "152"
"-21"     → "-21"
" +13.5 " → "+13.5"
"437.50X" → "437.50"
"Foo Bar" → ""
"-654-.-546-" → "-654-.-546-"
```

Only allow `0-9`, `+`, `-`, `.`, and thousand separator `,`.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Car {
  #[Filter\FloatChars(allowThousand: true)]
  public string $odometer;
}
```

```php
"45,452.3"  → "45,452.3"
"-3,500.50" → "-3,500.50"
"Foo Bar"   → ""
"-654,.,546-" → "-654,.,546-"
```

Only allow `0-9`, `+`, `-`, `.`, and scientific notation characters `e`, `E`.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Car {
  #[Filter\FloatChars(allowScientific: true)]
  public string $odometer;
}
```

```php
"15e6"     → "15e6"
"173E-5"     → "173E-5"
"Foo 33 Bar" → "33"
"-+E123..." → "-+E123..."
```

## See also

[IntegerChars](IntegerChars.md) - Remove all characters except `0-9`, `+`, `-`,
and `.`.

