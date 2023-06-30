<?php declare(strict_types=1);

namespace Jawira\Sanitizer;

use Jawira\Sanitizer\Filters\FilterInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

class SanitizerService
{
  public function sanitize(object $toSanitize): void
  {
    $reflectionClass = new ReflectionClass($toSanitize);
    $allProperties = $reflectionClass->getProperties();
    foreach ($allProperties as $reflectionProperty) {
      $this->sanitizeProperty($toSanitize, $reflectionProperty);
    }
  }

  private function sanitizeProperty(object $object, ReflectionProperty $reflectionProperty): void
  {
    // Is this property initialized ?
    $reflectionProperty->setAccessible(true);
    if (!$reflectionProperty->isInitialized($object)) {
      return;
    }

    // extract all attributes
    $attributes = $reflectionProperty->getAttributes();
    foreach ($attributes as $attribute) {
      $this->applyFilter($object, $reflectionProperty, $attribute);
    }
  }

  private function applyFilter(object $object, ReflectionProperty $reflectionProperty, ReflectionAttribute $attribute): void
  {
    // Check is Sanitizer
    $filter = $attribute->newInstance();
    if (!$filter instanceof FilterInterface) {
      return;
    }

    $oldValue = $reflectionProperty->getValue($object);
    if (!$filter->preConditions($oldValue)) {
      return;
    }

    $newValue = $filter->filter($oldValue);
    $reflectionProperty->setValue($object, $newValue);
  }
}
