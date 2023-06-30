<?php declare(strict_types=1);

namespace Jawira\Sanitizer;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

class SanitizerService implements SanitizerInterface
{
  public function sanitize(object $object): void
  {
    $reflectionClass = new ReflectionClass($object);
    array_map(fn(ReflectionProperty $reflectionProperty) => $this->sanitizeProperty($object, $reflectionProperty), $reflectionClass->getProperties());
  }

  private function sanitizeProperty(object $object, ReflectionProperty $reflectionProperty): void
  {
    $reflectionProperty->setAccessible(true);
    if (!$reflectionProperty->isInitialized($object)) {
      return;
    }

    foreach ($reflectionProperty->getAttributes() as $attribute) {
      $this->applyFilter($object, $reflectionProperty, $attribute);
    }
  }

  private function applyFilter(object $object, ReflectionProperty $reflectionProperty, ReflectionAttribute $attribute): void
  {
    $filter = $attribute->newInstance();
    if (!$filter instanceof Filters\FilterInterface) {
      return;
    }

    /** @var mixed $oldValue */
    $oldValue = $reflectionProperty->getValue($object);
    if (!$filter->check($oldValue)) {
      return;
    }

    $newValue = $filter->filter($oldValue);
    $reflectionProperty->setValue($object, $newValue);
  }
}
