<?php declare(strict_types=1);

namespace Jawira\Sanitizer;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;
use function array_map;
use function assert;

/**
 * Sanitizer service.
 */
class Sanitizer implements SanitizerInterface
{
  public function sanitize(object $object): void
  {
    $reflectionClass = new ReflectionClass($object);
    $mapper = fn(ReflectionProperty $reflectionProperty): bool => $this->sanitizeProperty($object, $reflectionProperty);
    array_map($mapper, $reflectionClass->getProperties());
  }

  /**
   * @return bool Return value is useless but required by `array_map` function.
   */
  private function sanitizeProperty(object $object, ReflectionProperty $reflectionProperty): bool
  {
    if (!$reflectionProperty->isInitialized($object)) {
      return false;
    }
    $mapper = function (ReflectionAttribute $attribute) use ($object, $reflectionProperty): bool {
      $filter = $attribute->newInstance();
      assert($filter instanceof Attribute\CleanerInterface);

      return $this->applyFilter($object, $reflectionProperty, $filter);
    };
    array_map($mapper, $reflectionProperty->getAttributes(Attribute\CleanerInterface::class, ReflectionAttribute::IS_INSTANCEOF));

    return true;
  }

  /**
   * @return bool Return value is useless but required by `array_map` function.
   */
  private function applyFilter(object $object, ReflectionProperty $reflectionProperty, Attribute\CleanerInterface $filter): bool
  {
    /** @var mixed $oldValue */
    $oldValue = $reflectionProperty->getValue($object);
    if (!$filter->precondition($oldValue)) {
      return false;
    }

    /** @var mixed $newValue */
    $newValue = $filter->filter($oldValue);
    $reflectionProperty->setValue($object, $newValue);

    return true;
  }
}
