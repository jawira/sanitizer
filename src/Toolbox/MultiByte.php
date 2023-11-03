<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Toolbox;
use ValueError;

class MultiByte
{
  /**
   * Replacement for mb_str_pad function.
   *
   * <b>mb_str_pad</b> function is only available since <i>PHP 8.3</i>.
   *
   * This method is a copy from {@link https://github.com/symfony/polyfill/blob/1.x/src/Php83/Php83.php}.
   */
  public static function StringPad(string $string, int $length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, string $encoding = null): string
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
