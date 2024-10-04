# @NAME@

@NAME@ - xxxxxxxxxxxxxxxxxxxxxx.

@NAME@ only works with `xxxxxxxxxxxx`, any other type is ignored.

## Basic usage

```php
use Jawira\Sanitizer\Attribute as Filter;

class User {
  #[Filter\xxxxxxxxxxxxxxxxxxxxxx]
  public string $name;
}
```

## Parameters

<dl>
<dt><em>type</em> <code>param1</code>:</dt>
<dd>xxxxxxxxxxxxxxxxxxxxxx.</dd>
<dt><em>type</em> <code>param2</code> (optional):</dt>
<dd>
xxxxxxxxxxxxxxxxxxxxxx.<br>
xxxxxxxxxxxxxxxxxxxxxx.
</dd>
</dl>

## Examples

xxxxxxxxxxxxxxxxxxxxxx.

```php
use Jawira\Sanitizer\Attribute as Filter;

class User {
  #[Filter\xxxxxxxxxxxxxxxxxxxxxx]
  public string $name;
}
```

```php
"Paul    " → "Paul"
"Paul\r\n" → "Paul"
```

## See also

XXX - xxxxxxxxxxxxxxxxxxxxxx.
