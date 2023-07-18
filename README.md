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

Call `Sanitizer::sanitize` method to apply sanitizers:

```php
use Jawira\Sanitizer\Sanitizer;

$sanitizer = new Sanitizer();
$user = new User();
$user->name = ' BOB ';

$sanitizer->sanitize($user);
echo $user->name; // 'Bob'
```

Interface `SanitizerInterface` is also available.

## Documentation

<https://jawira.github.io/sanitizer/>

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
