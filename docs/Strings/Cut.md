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
If desired length is positive, the resulting string will start from the beginning of the string.<br>
If length is negative, the resulting string will start from the ending of the string.
</dd>

<dt><em>bool</em> <code>useBytes</code> (optional):</dt>
<dd>
When false, length will represent characters.<br>
If true, length will be in bytes.<br>
Default value is <em>false</em>.
</dd>

</dl>

## Examples

Limit the length of string to 5 characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Project {
  #[Sanitizer\Cut(length: 5)]
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
  #[Sanitizer\Cut(length: -3)]
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

class Project {
  #[Sanitizer\Cut(length: 3, useBytes: true)]
  public string $name;
}
```

```php
"CPU-486"   → "CPU"
"しょうぼうし" → "し"
```

## See also

* [Trim](Trim.md) - Strip whitespace (or other characters) from the beginning and end of a string.
