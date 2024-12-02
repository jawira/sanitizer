# Slug

Slug - Converts text in a URL friendly format.

Slug only works with `string`, any other type is ignored.

This function is multibyte safe.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Product {
  #[Filter\Slug]
  public string $code;
}
```

## Parameters

No parameters.

## Examples

Add leading zeros when string has less than three characters:

```php
use Jawira\Sanitizer\Cleaners as Filter;
use Jawira\Sanitizer\Enums\Side;

class BlogPost {
  #[Filter\Slug]
  public string $code;
}
```

```php
"Moño Fácil 123"   → "Mono-Facil-123"
"はい"  → "hai"
```

## See also

[Trim](Trim.md) - Strip whitespace (or other characters) from the beginning and
end of a string.
