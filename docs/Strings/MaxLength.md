# MaxLength

MaxLength - Limit string length.

MaxLength only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Article {
  #[Sanitizer\MaxLength(length: 255)]
  public string $title;
}
```

## Parameters

<dl>

<dt><em>int</em> <code>length</code>:</dt>
<dd>
If desired length is positive, the resulting string will start from the beginning of the string.<br>
If length is negative, the resulting string will start from the ending of the string.
</dd>

<dt><em>StringMode</em> <code>stringMode</code> (optional):</dt>
<dd>
Use enum <code>\Jawira\Sanitizer\Enums\StringMode</code> to define how to measure string length.<br>

<ul>
<li><code>StringMode::Characters</code> - string is measured in characters (default value).</li>
<li><code>StringMode::Bytes</code> - string is measured in bytes.</li>
<li><code>StringMode::Graphemes</code> - string is measured in graphemes.</li>
</ul>
</dd>

</dl>

## Examples

Limit the length of string to 5 characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Project {
  #[Sanitizer\MaxLength(5)]
  public string $name;
}
```

```php
"CPU-486"   → "CPU-4"
"しょうぼうし" → "しょうぼう"
```

Limit the length of string to the last 3 characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Project {
  #[Sanitizer\MaxLength(-3)]
  public string $name;
}
```

```php
"CPU-486"   → "486"
"しょうぼうし" → "ぼうし"
```

The string must be 3 bytes in size.

```php
use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\Enums\StringMode;

class Project {
  #[Sanitizer\MaxLength(3, StringMode::Bytes)]
  public string $name;
}
```

```php
"CPU-486"   → "CPU"
"しょうぼうし" → "し"
```

## See also

* [Trim](Trim.md) - Strip whitespace (or other characters) from the beginning and end of a string.
