# EmptyStringToNull

EmptyStringToNull - Set _null_ if value is empty _string_.

EmptyStringToNull only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Article {
  #[Filter\EmptyStringToNull]
  public ?string $category;
}
```

## Parameters

No parameters.

## Examples

Set null if value is empty string.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class User {
  #[Filter\EmptyStringToNull]
  public ?string $name;
}
```

```php
"John" → "John"
" " → " "
"" → null
```

## See also

[Trim](../Strings/Trim.md) - Strip whitespace (or other characters) from the beginning and end of a string.
