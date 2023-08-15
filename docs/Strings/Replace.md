# Replace

Replace - Replace all occurrences of the search _string_ with the replacement
_string_.

Replace only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\Replace(search: ' ', replace: '_')]
  public string $name;
}
```

## Parameters

<dl>
<dt><em>string</em> <code>search</code>:</dt>
<dd>The string you want to replace. </dd>
<dt><em>string</em> <code>replace</code>:</dt>
<dd>The replacement string.</dd>
<dt><em>string</em> <code>caseSensitive</code> (optional):</dt>
<dd>
Search is case-sensitive, set this parameter to _false_ to perform a case-insensitive search.<br>
Default value is _true_.
</dd>
</dl>

## Examples

Remove all whitespace characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\Replace(search: ' ', replace: '')]
  public string $email;
}
```

```php
"  bob@example.com   " → "bob@example.com"
"bob  @   example.com" → "bob@example.com"
" bob @ example .com " → "bob@example.com"
```

Replace a string by another.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Order {
  #[Sanitizer\Replace('pizza', 'fries')]
  public string $description;
}
```

```php
"Client wants pizza." → "Client wants fries."
```

Perform case-insensitive search.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Famous {
  #[Sanitizer\Replace('del toro', 'del Toro')]
  public string $name;
}
```

```php
"Guillermo del toro" → "Guillermo del Toro"
"Guillermo DEL TORO" → "Guillermo del Toro"
```

## See also

[StripTags](StripTags.md) - Strip HTML and PHP tags from a _string_.
