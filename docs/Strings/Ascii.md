# Ascii

Ascii - Remove all characters except ascii characters.

In practice this means that all characters with a numerical value greater than 127 are removed.

Ascii sanitizer only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\Ascii]
  public string $username;
}
```

## Parameters

<dl>
<dt><em>bool</em> <code>onlyPrintable</code> (optional):</dt>
<dd>
Default value is <code>false</code>, all ascii characters are preserved.<br>
When <code>true</code> all characters with numerical value less than 32 are
also removed, this is the first column of the following table.
</dd>
</dl>

![Ascii table](asciifull.gif)

## Examples

Remove all non-ascii characters:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Message {
  #[Sanitizer\Ascii]
  public string $content;
}
```

```php
"Único"    → "nico"
"Γεια σας" → " "
"Foo\nBar" → "Foo\nBar"
"\tHello"  → "\tHello"
```

Remove all non-ascii characters and removing non-printable characters:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Message {
  #[Sanitizer\Ascii(onlyPrintable: true)]
  public string $content;
}
```

```php
"Único"    → "nico"
"Γεια σας" → " "
"Foo\nBar" → "FooBar"
"\tHello"  → "Hello"
```
## See also

-
