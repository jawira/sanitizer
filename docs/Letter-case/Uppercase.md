# Uppercase

Uppercase - Make a _string_ uppercase.

Uppercase only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
  #[Filter\Uppercase]
  public string $initials;
}
```

## Parameters

No parameters.

## Examples

Convert string to lowercase letters.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\Uppercase]
  public string $keywords;
}
```

```php
"foo" → "FOO"
"Bar Baz" → "BAR BAZ"
"prêt-à-porter" → "PRÊT-À-PORTER"
```

## See also

* [Lowercase](Lowercase.md) - Make a _string_ lowercase.
* [Title](Title.md) - Converts the first letter of each word to uppercase and leaves the others as lowercase.
