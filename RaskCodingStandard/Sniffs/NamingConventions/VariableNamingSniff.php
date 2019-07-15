<?php declare(strict_types = 1);

namespace RaskCodingStandard\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Class VariableNamingSniff
 *
 * Enforce snake_case property names, that can only contain a-z, 0-9, and underscores. No more than
 * one underscore at a time. Cannot start or end with an underscore.
 */
class VariableNamingSniff implements Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @see Tokens.php
     * @return array<int>
     */
    public function register() : array
    {
        return [T_VARIABLE];
    }

    /**
     * Called when one of the token types that this sniff is listening for is found.
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration
     *
     * @param File $phpcs_file The PHP_CodeSniffer file where the token was found.
     * @param mixed $stack_ptr The position in the PHP_CodeSniffer file's token stack where the
     *                         token was found.
     *
     * @return void|int
     */
    public function process(File $phpcs_file, $stack_ptr)
    {
        $variable_token = $phpcs_file->getTokens()[$stack_ptr];

        $variable_name = $variable_token['content'];

        // Snake case with lowercase alphanumerics only.
        $pattern = '%^\$[a-z]+[a-z0-9_]+[a-z0-9]$%';
        $pattern_matches = preg_match($pattern, $variable_name) > 0;

        $is_valid = $pattern_matches && strpos($variable_name, '__') === false;

        if (!$is_valid) {
            $error = 'Variable names must be snake_case and consist only of '
                . 'a-z, 0-9, and _ characters, and cannot start or end with a _ character, found `'
                . $variable_name . '`';

            $phpcs_file->addError($error, $stack_ptr, 'Found', $variable_name);
        }
    }
}
