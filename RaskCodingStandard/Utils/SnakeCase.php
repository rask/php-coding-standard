<?php declare(strict_types = 1);

namespace RaskCodingStandard\Utils;

/**
 * Class SnakeCase
 */
class SnakeCase
{
    /**
     * Validate that a string subject is in proper snakecase format.
     *
     * 1. Starts with `a-z`
     * 2. Ends with `a-z` or `0-9`
     * 3. Does not contain anything else than `a-z`, `0-9`, and `_`
     * 4. Does not contain double-underscores `__`.
     */
    public static function isSnakeCase(string $subject) : bool
    {
        $pattern = '%^[a-z][a-z0-9_]*$%';
        $pattern_matches = \preg_match($pattern, $subject) > 0;

        $end_ok = \strpos($subject, '_') !== \strlen($subject) - 1;
        $no_doubles = \strpos($subject, '__') === false;

        return $pattern_matches && $end_ok && $no_doubles;
    }
}
