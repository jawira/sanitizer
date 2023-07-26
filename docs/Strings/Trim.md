# Trim

Trim - Strip whitespace (or other characters) from the beginning and end of a string.

Trim only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\Trim]
  public string $name;
}
```

## Parameters

<dl>
<dt><em>string</em> <code>characters</code> (optional):</dt>
<dd>Set of characters you want to remove, default value is "<code> \t\n\r\0\x0B</code>".</dd>
<dt><em>string</em> <code>side</code> (optional):</dt>
<dd>
Use <code>both</code> to apply trim at the beginning and the end of string, this is the default value.<br>
Use <code>left</code> to apply trim at the beginning of string.<br>
Use <code>right</code> to apply trim at the end of string.
</dd>
</dl>

## Examples

Remove spaces from the beginning and end of string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim]
    public string $name;
}
```

```php
"Paul    " → "Paul"
"  Paul  " → "Paul"
"    Paul" → "Paul"
"\t\tPaul" → "Paul"
"Paul\r\n" → "Paul"
```

Remove spaces at the end of the string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim(side: 'right')]
    public string $name;
}
```

```php
"Paul    " → "Paul"
"  Paul  " → "  Paul"
"    Paul" → "    Paul"
"\t\tPaul" → "\t\tPaul"
"Paul\r\n" → "Paul"
```

Remove plus and minus signs at the beginning of the string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim(side: 'left', characters: '+-')]
    public string $name;
}
```

```php
"    Paul    " → "    Paul    "
"-+-+Paul+-+-" → "Paul+-+-"
```

## See also

[Pad](Pad.md) - Pad a string to a certain length with another string.