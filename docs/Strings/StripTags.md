# StripTags

StripTags - Strip HTML and PHP tags from a _string_.

StripTags only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\StripTags]
  public string $content;
}
```

## Parameters

<dl>
<dt><em>type</em> <code>array</code> (optional):</dt>
<dd>
Array of allowed tags.<br>
Default value is empty array.
</dd>
</dl>

## Examples

Strip all html tags.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\StripTags]
  public string $content;
}
```

```php
"Foo<br>Bar" → "FooBar"
"<p>Hello <strong>John</strong></p>" → "Hello John"
"Foo <!-- comment --> Bar" → "Foo  Bar"
```

Strip all html tags but `<br>` and `<p>` tags.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\StripTags(allowedTags: ['br', 'p'])]
  public string $content;
}
```

```php
"Foo<br>Bar" → "Foo<br>Bar"
"<p>Hello <strong>John</strong></p>" → "<p>Hello John</p>"
```

## See also

[Replace](Replace.md) - Replace all occurrences of the search _string_ with the
replacement _string_.
