# 😷 jawira/sanitizer

**Sanitize your objects with attributes.**

[![Latest Stable Version](http://poser.pugx.org/jawira/sanitizer/v)](https://packagist.org/packages/jawira/sanitizer)
[![Total Downloads](http://poser.pugx.org/jawira/sanitizer/downloads)](https://packagist.org/packages/jawira/sanitizer)
[![PHP Version Require](http://poser.pugx.org/jawira/sanitizer/require/php)](https://packagist.org/packages/jawira/sanitizer)
[![License](http://poser.pugx.org/jawira/sanitizer/license)](https://packagist.org/packages/jawira/sanitizer)

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

## Available sanitizers

| Sanitizer             | Works with                                 | Description                                                                             |
|-----------------------|--------------------------------------------|-----------------------------------------------------------------------------------------|
| **Abs**               | _int_, _float_                             | Absolute value.                                                                         |
| **Ascii**             | _string_                                   | Remove all characters except ascii characters.                                          |
| **AtLeast**           | _int_, _float_                             | Value is at least equal to provided number.                                             |
| **AtMost**            | _int_, _float_                             | Value is at most equal to provided number.                                              |
| **Capitalize**        | _string_                                   | Converts the first letter of each word to uppercase and leaves the others as lowercase. |
| **Digits**            | _string_                                   | Remove all characters except digits.                                                    |
| **EmptyStringToNull** | _string_                                   | Set _null_ if value is empty _string_.                                                  |
| **FloatChars**        | _string_                                   | Remove all characters except digits, `+-.` and optionally `,eE`.                        |
| **IntegerChars**      | _string_                                   | Remove all characters except digits, plus and minus sign.                               |
| **Lowercase**         | _string_                                   | Make a _string_ lowercase.                                                              |
| **Pad**               | _string_                                   | Pad a _string_ to a certain length with another _string_.                               |
| **Replace**           | _string_                                   | Replace all occurrences of the search _string_ with the replacement _string_.           |
| **StripTags**         | _string_                                   | Strip HTML and PHP tags from a _string_.                                                |
| **ToInt**             | _null_, _bool_, _float_, _string_, _array_ | Cast to _integer_.                                                                      |
| **ToString**          | _null_, _bool_, _int_, _float_, _array_    | Cast to _string_.                                                                       |
| **Trim**              | _string_                                   | Strip whitespace (or other characters) from the beginning and end of a _string_.        |
| **Uppercase**         | _string_                                   | Make a _string_ uppercase.                                                              |

## Install

```console
composer require jawira/sanitizer
```

## Security

> **Warning**<br>
> Sanitization is not a replacement for a proper data validation mechanism and
> database constraints.

## License

This library is licensed under the [MIT license](LICENSE.md).

***

## Packages from jawira

<dl>

<dt>
  <a href="https://packagist.org/packages/jawira/doctrine-diagram-bundle">jawira/doctrine-diagram-bundle
  <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/doctrine-diagram-bundle?icon=github"/></a>
</dt>
<dd>Symfony Bundle to generate database diagrams.</dd>

<dt>
  <a href="https://packagist.org/packages/jawira/case-converter">jawira/case-converter
  <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/case-converter?icon=github"/></a>
</dt>
<dd>Convert strings between 13 naming conventions: Snake case, Camel case,
  Pascal case, Kebab case, Ada case, Train case, Cobol case, Macro case,
  Upper case, Lower case, Sentence case, Title case and Dot notation.
</dd>

<dt>
  <a href="https://packagist.org/packages/jawira/emoji-catalog">jawira/emoji-catalog
  <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/emoji-catalog?icon=github"/></a>
</dt>
<dd>Get access to +3000 emojis as class constants.</dd>

<dt><a href="https://packagist.org/packages/jawira/">more...</a></dt>
</dl>
