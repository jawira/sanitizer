# Slug

Slug - Converts text in a URL friendly format.

Slug only works with `string`, any other type is ignored.

This function is multibyte safe.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class Product {
  #[Sanitizer\Slug]
  public string $code;
}
```

## Parameters

No parameters.

## Examples

Add leading zeros when string has less than three characters:

```php
use Jawira\Sanitizer\Filters as Sanitizer;
use Jawira\Sanitizer\Enums\Side;

class BlogPost {
  #[Sanitizer\Slug]
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
