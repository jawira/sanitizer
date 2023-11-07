# Pad

Pad - Pad a string to a certain length with another string.

Pad only works with `string`, any other type is ignored.
This function is multibyte safe.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Report {
  #[Sanitizer\Pad(length: 10)]
  public string $category;
}
```

## Parameters

<dl>
<dt><em>int</em> <code>length</code>:</dt>
<dd>Length of resulting string once pad is applied.</dd>
<dt><em>string</em> <code>padString</code> (optional):</dt>
<dd>
String to use as pad.<br>
The default value is "<em>space</em>" character.
</dd>
<dt><em>Side</em> <code>side</code> (optional):</dt>
<dd>
Use enum <code>\Jawira\Sanitizer\Enums\Side</code> to specify pad behaviour.<br>
<ul>
<li><code>Side::Both</code> - to apply pad at the beginning and the end of string (default value).</li>
<li><code>Side::Left</code> - to apply pad at the beginning of string.</li>
<li><code>Side::Right</code> - to apply pad at the end of string.</li>
</ul>
</dd>
</dl>

## Examples

Add leading zeros when string has less than three characters:

```php
use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\Enums\Side;

class Classroom {
  #[Sanitizer\Pad(length: 3, padString: '0', side: Side::Left)]
  public string $number;
}
```

```php
"1"   → "001"
"50"  → "050"
"312" → "312"
```

Create 30 characters width _ascii art_ header:

```php
use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\Enums\Side;

class AsciiArt {
  #[Sanitizer\Pad(length: 30, padString: '-+-', side: Side::Both)]
  public string $title;
}
```

```php
"CREDITS"       → "-+--+--+--+CREDITS-+--+--+--+-"
"DOCUMENTATION" → "-+--+--+DOCUMENTATION-+--+--+-"
"AUTHOR"        → "-+--+--+--+-AUTHOR-+--+--+--+-"
```

Right padding of 30 characters with asterisk symbol:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Paycheck {
  #[Sanitizer\Pad(length: 30, padString: '*')]
  public string $writtenAmount;
}
```

```php
"four thousand"             → "four thousand*****************"
"one thousand five hundred" → "one thousand five hundred*****"
```

Pad sanitizer is multibyte safe:

```php
use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\Enums\Side;

class MyEmoji {
  #[Sanitizer\Pad(length: 6, padString: '🍍', side: Side::Both)]
  public string $title;
}
```

```php
"Piña" → "🍍Piña🍍"
```

## See also

[Trim](Trim.md) - Strip whitespace (or other characters) from the beginning and
end of a string.
