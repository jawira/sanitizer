# Title

Title - Converts the first letter of each word to uppercase and leaves the
others as lowercase.

Title only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\Title]
  public string $title;
}
```

## Parameters

No parameters.

## Examples

Set value in title case.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\Title]
  public string $title;
}
```

```php
"déjà vu" → "Déjà Vu"
"prêt-à-porter" → "Prêt-À-Porter"
"foo   bar   baz" → "Foo   Bar   Baz"
```

## See also

* [Lowercase](Lowercase.md) - Make a _string_ lowercase.
* [Uppercase](Uppercase.md) - Make a _string_ uppercase.
