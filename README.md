# 😷 jawira/sanitizer

Sanitize your classes using attributes.

## Usage

Add sanitizer attributes to your class:

```php
use Jawira\Sanitizer\Filters as Sanitizer;

class User {
    #[Sanitizer\Trim]
    public string $name;
}
```

Call `SanitizerService::sanitize` method to apply sanitizers:

```php
use Jawira\Sanitizer\SanitizerService;

$sanitizer = new SanitizerService();
$user = new User();
$user->name = ' Bob ';

echo $user->name; // Before: ' Bob '
$sanitizer->sanitize($user);
echo $user->name; // After: 'Bob'
```

### Install

```console
composer require jawira/sanitizer
```


