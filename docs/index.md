# Home

## List of sanitizers

| Sanitizer                                         | Works with                                    | Description                                                                             |
|---------------------------------------------------|-----------------------------------------------|-----------------------------------------------------------------------------------------|
| [Abs](Numbers/Abs.md)                             | _int_, _float_                                | Absolute value.                                                                         |
| [Ascii](Strings/Ascii.md)                         | _string_                                      | Remove all characters except ascii characters.                                          |
| [AtLeast](Numbers/AtLeast.md)                     | _int_, _float_                                | Value is at least equal to provided number.                                             |
| [AtMost](Numbers/AtMost.md)                       | _int_, _float_                                | Value is at most equal to provided number.                                              |
| [Digits](Numeric-strings/Digits.md)               | _string_                                      | Remove all characters except digits.                                                    |
| [EmptyStringToNull](Strings/EmptyStringToNull.md) | _string_                                      | Set _null_ if value is empty _string_.                                                  |
| [FloatChars](Numeric-strings/FloatChars.md)       | _string_                                      | Remove all characters except `0-9`, `+`, `-`, `.` and optionally `,`, `e`, and `E`.     |
| [IntegerChars](Numeric-strings/IntegerChars.md)   | _string_                                      | Remove all characters except `0-9`, `+`, `-`.                                           |
| **Lowercase**                                     | _string_                                      | Make a _string_ lowercase.                                                              |
| [Pad](Strings/Pad.md)                             | _string_                                      | Pad a _string_ to a certain length with another _string_.                               |
| **Replace**                                       | _string_                                      | Replace all occurrences of the search _string_ with the replacement _string_.           |
| **StripTags**                                     | _string_                                      | Strip HTML and PHP tags from a _string_.                                                |
| **Substring**                                     | _string_                                      | Reduce the size of _string_ to provided length.                                         |
| [Title](Strings/Title.md)                         | _string_                                      | Converts the first letter of each word to uppercase and leaves the others as lowercase. |
| **ToInt**                                         | _null_, _bool_, _float_,<br>_string_, _array_ | Cast to _integer_.                                                                      |
| **ToString**                                      | _null_, _bool_, _int_,<br>_float_, _array_    | Cast to _string_.                                                                       |
| [Trim](Strings/Trim.md)                           | _string_                                      | Strip whitespace (or other characters) from the beginning and end of a _string_.        |
| **Uppercase**                                     | _string_                                      | Make a _string_ uppercase.                                                              |
