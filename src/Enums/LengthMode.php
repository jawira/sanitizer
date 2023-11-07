<?php declare(strict_types=1);

namespace Jawira\Sanitizer\Enums;

enum LengthMode: string
{
  case Bytes = 'bytes';
  case Characters = 'characters';
  case Graphemes = 'graphemes';
}
