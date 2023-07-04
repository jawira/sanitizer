# Trim

**Strip whitespace (or other characters) from the beginning and end of a string.**

`Trim` only works with `string`, any other type is ignored.

## Parameters

<dl>
<dt>characters:</dt>
<dd>Set of characters you want to remove, default value is "<code> \t\n\r\0\x0B</code>".</dd>
<dt>direction:</dt>
<dd>
Use <code>both</code> to apply trim at the beginning and the end of string, this is the default value.<br>
Use <code>left</code> to apply trim at the beginning of string.<br>
Use <code>right</code> to apply trim at the end of string.
</dd>
</dl>

## Examples

Remove spaces from the beggining and end of string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim]
    private string $name;
}
```

Remove spaces at the end of the string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim(side: 'right')]
    private string $name;
}
```

Remove periods, commas and tabulations at the beginning of the string:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim(side: 'left', characters: ".,\t")]
    private string $name;
}
```

## See also

[Pad](pad.md)
