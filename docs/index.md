## Usage

Add sanitizer attributes to your class:

```php
use Jawira\Sanitizer\Attribute as Filter;

class User {
    #[Filter\Trim]
    #[Filter\Title]
    public string $name;
}
```

Call `Sanitizer::sanitize` method to apply sanitizers on object:

```php
use Jawira\Sanitizer\Sanitizer;

// Setting value
$user = new User();
$user->name = ' BOB ';

// Cleaning object's properties
$sanitizer = new Sanitizer();
$sanitizer->sanitize($user);

echo $user->name; // 'Bob'
```

Interface `SanitizerInterface` is also available.

## List of available sanitizers

### Cast sanitizers

| Sanitizer                                      | Works with                                    | Description                            |
|------------------------------------------------|-----------------------------------------------|----------------------------------------|
| [EmptyStringToNull](Cast/EmptyStringToNull.md) | _string_                                      | Set _null_ if value is empty _string_. |
| [ToInt](Cast/ToInt.md)                         | _null_, _bool_, _float_,<br>_string_, _array_ | Cast value to _integer_.               |
| [ToString](Cast/ToString.md)                   | _null_, _bool_, _int_,<br>_float_, _array_    | Cast value to _string_.                |

### Letter case sanitizers

| Sanitizer                             | Works with | Description                                                                             |
|---------------------------------------|------------|-----------------------------------------------------------------------------------------|
| [Lowercase](Letter-case/Lowercase.md) | _string_   | Make a _string_ lowercase.                                                              |
| [Title](Letter-case/Title.md)         | _string_   | Converts the first letter of each word to uppercase and leaves the others as lowercase. |
| [Uppercase](Letter-case/Uppercase.md) | _string_   | Make a _string_ uppercase.                                                              |

### Numbers  sanitizers

| Sanitizer                       | Works with     | Description                                 |
|---------------------------------|----------------|---------------------------------------------|
| [Absolute](Numbers/Absolute.md) | _int_, _float_ | Absolute value.                             |
| [AtLeast](Numbers/AtLeast.md)   | _int_, _float_ | Value is at least equal to provided number. |
| [AtMost](Numbers/AtMost.md)     | _int_, _float_ | Value is at most equal to provided number.  |

### Numeric strings sanitizers

| Sanitizer                                       | Works with | Description                                                                         |
|-------------------------------------------------|------------|-------------------------------------------------------------------------------------|
| [Digits](Numeric-strings/Digits.md)             | _string_   | Remove all characters except digits.                                                |
| [FloatChars](Numeric-strings/FloatChars.md)     | _string_   | Remove all characters except `0-9`, `+`, `-`, `.` and optionally `,`, `e`, and `E`. |
| [IntegerChars](Numeric-strings/IntegerChars.md) | _string_   | Remove all characters except `0-9`, `+`, `-`.                                       |

### Strings sanitizers

| Sanitizer                         | Works with | Description                                                                      |
|-----------------------------------|------------|----------------------------------------------------------------------------------|
| [Ascii](Strings/Ascii.md)         | _string_   | Remove all characters except ascii characters.                                   |
| [MaxLength](Strings/MaxLength.md) | _string_   | Limit string length.                                                             |
| [Pad](Strings/Pad.md)             | _string_   | Pad a _string_ to a certain length with another _string_.                        |
| [Replace](Strings/Replace.md)     | _string_   | Replace all occurrences of the search _string_ with the replacement _string_.    |
| [StripTags](Strings/StripTags.md) | _string_   | Strip HTML and PHP tags from a _string_.                                         |
| [Trim](Strings/Trim.md)           | _string_   | Strip whitespace (or other characters) from the beginning and end of a _string_. |
