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

        $start_ok = \mb_strpos($subject, '_') !== 0;
        $end_ok = \mb_strpos($subject, '_') !== mb_strlen($subject) - 1;
        $no_doubles = \mb_strpos($subject, '__') === false;

        return $pattern_matches && $start_ok && $end_ok && $no_doubles;
    }
}
