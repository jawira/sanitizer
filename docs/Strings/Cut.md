# Cut

Cut - Limit string length.

Cut only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Article {
  #[Sanitizer\Cut(length: 255)]
  public string $title;
}
```

## Parameters

<dl>

<dt><em>int</em> <code>length</code>:</dt>
<dd>
Maximum length of string.<br>
Use _null_ to set the length is used the length is the end of string.<br>
Default value is _null_.
</dd>

</dl>

## Examples

Limit the length of string to 5 characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Project {
  #[Sanitizer\Cut(length: 5)]
  public string $code;
}
```

```php
"CP1"     → "CP1"
"CP008"   → "CP008"
"CP00855" → "CP008"
"CP5139"  → "CP513"
```

Remove the last 6 characters from a string.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Project {
  #[Sanitizer\Cut(length: -6)]
  public string $code;
}
```

```php
"Hello world" → "Hello"
```

## See also

XXX - xxxxxxxxxxxxxxxxxxxxxx.
