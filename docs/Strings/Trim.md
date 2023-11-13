# Trim

Trim - Strip whitespace (or other characters) from the beginning and end of a
string.

Trim only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
  #[Filter\Trim]
  public string $name;
}
```

## Parameters

<dl>
<dt><em>string</em> <code>characters</code> (optional):</dt>
<dd>Set of characters you want to remove, default value is "<code> \t\n\r\0\x0B</code>".</dd>
<dt><em>Side</em> <code>side</code> (optional):</dt>
<dd>
Use enum <code>\Jawira\Sanitizer\Enums\Side</code> to specify trim behaviour.<br>
<ul>
<li><code>Side::Both</code> - to apply trim at the beginning and the end of string (default value).</li>
<li><code>Side::Left</code> - to apply trim at the beginning of string.</li>
<li><code>Side::Right</code> - to apply trim at the end of string.</li>
</ul>
</dd>
</dl>

## Examples

Remove spaces from the beginning and end of string:

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
    #[Filter\Trim]
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
use Jawira\Sanitizer\Cleaners as Filter;
use \Jawira\Sanitizer\Enums\Side;
class User {
    #[Filter\Trim(Side::Right)]
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
use Jawira\Sanitizer\Cleaners as Filter;
use \Jawira\Sanitizer\Enums\Side;

class User {
    #[Filter\Trim(Side::Left, characters: '+-')]
    public string $name;
}
```

```php
"    Paul    " → "    Paul    "
"-+-+Paul+-+-" → "Paul+-+-"
```

## See also

[Pad](Pad.md) - Pad a string to a certain length with another string.
