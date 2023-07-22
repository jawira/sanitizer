# IntegerChars

IntegerChars - Remove all characters except `0-9`, `+`, `-`.

IntegerChars does not verify if a string is a well-formed integer string, it
only verifies that all characters belong to a certain character set.<br>
Therefore, even if it's counterintuitive, IntegerChars will leave the following
strings unmodified:

* "13"
* "-50"
* "+-8+-9"

IntegerChars only works with `string`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\IntegerChars]
  public string $age;
}
```

## Parameters

No parameters.

## Examples

Only allow `0-9`, `+`, `-` characters.

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
  #[Sanitizer\IntegerChars]
  public string $age;
}
```

```php
"13 year" → "13"
"+51 yo" → "+51"
"--7--" → "--7--"
```

## See also

* [FloatChars](FloatChars.md) - Remove all characters except `0-9`, `+`, `-`, `.`
and optionally `,`, `e`, and `E`.
* [Digits](Digits.md) - Remove all characters except digits.
