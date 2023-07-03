# 😷 jawira/sanitizer

Sanitize your classes using attributes.

## Usage

Add sanitizer attributes to your class:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim]
    #[Sanitizer\Capitalize]
    public string $name;
}
```

Call `SanitizerService::sanitize` method to apply sanitizers:

```php
use Jawira\Sanitizer\SanitizerService;

$sanitizer = new SanitizerService();
$user = new User();
$user->name = ' BOB ';

$sanitizer->sanitize($user);
echo $user->name; // After: 'Bob'
```

### Available sanitizers

| Sanitize       | Works with | Description                                                                             |
|----------------|------------|-----------------------------------------------------------------------------------------|
| **Ascii**      | _string_   | Remove all characters except ascii characters (numerical value >127).                   |
| **Capitalize** | _string_   | Converts the first letter of each word to uppercase and leaves the others as lowercase. |
| **Integer**    | _string_   | Remove all characters except digits, plus and minus sign.                               |
| **Lowercase**  | _string_   | Make a string lowercase.                                                                |
| **Pad**        | _string_   | Pad a string to a certain length with another string.                                   |
| **StripTags**  | _string_   | Strip HTML and PHP tags from a string.                                                  |
| **Trim**       | _string_   | Strip whitespace (or other characters) from the beginning and end of a string.          |
| **Uppercase**  | _string_   | Make a string uppercase.                                                                |

### Install

```console
composer require jawira/sanitizer
```

### Security

You must not solely rely on sanitization, you must implement a proper data validation mechanism.
