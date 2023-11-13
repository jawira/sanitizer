# Digits

Digits - Remove all characters except digits.

The following characters are considered a digit `0123456789`.

Digits only works with `strings`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Phone {
  #[Filter\Digits]
  public string $pinCode;
}
```

## Parameters

No parameters.

## Examples

Remove all characters but digits.

```php
use Jawira\Sanitizer\Cleaners as Filter;

class Phone {
  #[Filter\Digits]
  public string $pinCode;
}
```

```php
"0011" → "0011"
"9 7 0 1" → "9701"
" Code 4587" → "4587"
```

## See also

[IntegerChars](IntegerChars.md) - Remove all characters except `0-9`, `+`, `-`,
and `.`.

