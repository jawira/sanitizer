<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Filters;

use Attribute;
use Jawira\Sanitizer\Enums\Side;
use ValueError;
use const STR_PAD_BOTH;
use const STR_PAD_LEFT;
use const STR_PAD_RIGHT;
use function in_array;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Pad implements FilterInterface
{
  public function __construct(private readonly int    $length,
                              private readonly string $padString = ' ',
                              private readonly Side   $side = Side::Right)
  {
  }

  /**
   * `str_pad` function only accepts strings.
   */
  public function precondition(mixed $value): bool
  {
    return is_string($value);
  }

  /**
   * Apply `str_pad` function adding pad to the right.
   */
  public function filter(mixed $value): string
  {
    assert(is_string($value));
    $padType = match ($this->side) {
      Side::Left => STR_PAD_LEFT,
      Side::Right => STR_PAD_RIGHT,
      Side::Both => STR_PAD_BOTH,
    };

    $stringPad = function_exists('mb_str_pad') ? \mb_str_pad(...) : $this->mbStrPad(...);

    return $stringPad($value, $this->length, $this->padString, $padType);
  }

  /**
   * Polyfill for mb_str_pad function.
   *
   * <b>mb_str_pad</b> function is only available since <i>PHP 8.3</i>.
   *
   * This method is a copy from {@link https://github.com/symfony/polyfill/blob/1.x/src/Php83/Php83.php}.
   */
  private function mbStrPad(string $string, int $length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, string $encoding = null): string
  {
    if (!in_array($pad_type, [STR_PAD_RIGHT, STR_PAD_LEFT, STR_PAD_BOTH], true)) {
      throw new ValueError('mb_str_pad(): Argument #4 ($pad_type) must be STR_PAD_LEFT, STR_PAD_RIGHT, or STR_PAD_BOTH');
    }

    if (null === $encoding) {
      $encoding = mb_internal_encoding();
    }

    try {
      $validEncoding = @mb_check_encoding('', $encoding);
    } catch (ValueError $e) {
      throw new ValueError(sprintf('mb_str_pad(): Argument #5 ($encoding) must be a valid encoding, "%s" given', $encoding));
    }

    // BC for PHP 7.3 and lower
    if (!$validEncoding) {
      throw new ValueError(sprintf('mb_str_pad(): Argument #5 ($encoding) must be a valid encoding, "%s" given', $encoding));
    }

    if (mb_strlen($pad_string, $encoding) <= 0) {
      throw new ValueError('mb_str_pad(): Argument #3 ($pad_string) must be a non-empty string');
    }

    $paddingRequired = $length - mb_strlen($string, $encoding);

    if ($paddingRequired < 1) {
      return $string;
    }

    switch ($pad_type) {
      case STR_PAD_LEFT:
        return mb_substr(str_repeat($pad_string, $paddingRequired), 0, $paddingRequired, $encoding) . $string;
      case STR_PAD_RIGHT:
        return $string . mb_substr(str_repeat($pad_string, $paddingRequired), 0, $paddingRequired, $encoding);
      default:
        $leftPaddingLength = intval(floor($paddingRequired / 2));
        $rightPaddingLength = $paddingRequired - $leftPaddingLength;

        return mb_substr(str_repeat($pad_string, $leftPaddingLength), 0, $leftPaddingLength, $encoding) . $string . mb_substr(str_repeat($pad_string, $rightPaddingLength), 0, $rightPaddingLength, $encoding);
    }
  }
}
