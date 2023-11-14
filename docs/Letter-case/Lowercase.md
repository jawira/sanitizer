# Lowercase

Lowercase - Make a _string_ lowercase.

Lowercase only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
  #[Filter\Lowercase]
  public string $username;
}
```

## Parameters

No parameters.

## Examples

Convert string to lowercase letters.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\Lowercase]
  public string $keywords;
}
```

```php
"HELLO" → "hello"
"Foo Bar" → "foo bar"
"Γεια σας" → "γεια σας"
```

## See also

* [Title](Title.md) - Converts the first letter of each word to uppercase and leaves the others as lowercase.
* [Uppercase](Uppercase.md) - Make a _string_ uppercase.
