# Pad

Pad - Pad a string to a certain length with another string.

Pad only works with `string`, any other type is ignored.

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
<dt><em>string</em> <code>side</code> (optional):</dt>
<dd>
Use <code>right</code> to apply pad at the end of string, this is the default value.<br>
Use <code>left</code> to apply pad at the beginning of string.<br>
Use <code>both</code> to apply pad at the beginning and the end of string.
</dd>
</dl>

## Examples

Add leading zeros when string has less than three characters:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Classroom {
  #[Sanitizer\Pad(length: 3, padString: '0', side: 'left')]
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

class AsciiArt {
  #[Sanitizer\Pad(length: 30, padString: '-+-', side: 'both')]
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

## See also

[Trim](Trim.md) - Strip whitespace (or other characters) from the beginning and end of a string.
