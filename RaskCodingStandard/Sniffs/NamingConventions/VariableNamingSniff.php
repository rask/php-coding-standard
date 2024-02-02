<?php declare(strict_types = 1);

namespace RaskCodingStandard\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use RaskCodingStandard\Utils\SnakeCase;

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
     *
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
     */
    public function process(File $phpcs_file, mixed $stack_ptr) : void
    {
        $stack_ptr = \is_numeric($stack_ptr)
            ? (int) $stack_ptr
            : throw new \RuntimeException('Non-integer stack pointer given');

        $variable_token = $phpcs_file->getTokens()[$stack_ptr];

        $variable_name = \ltrim($variable_token['content'], '$');

        if ($this->isPredefinedVariable($variable_name)) {
            return;
        }

        if ($variable_name === '_') {
            // Allow these "throwaway" names.
            return;
        }

        if (SnakeCase::isSnakeCase($variable_name) === false) {
            $error = 'Variable names must be snake_case and consist only of a-z, 0-9, and _ '
                . 'characters, and cannot start or end with a _ character, or contain two '
                . 'adjacent _ characters, found `$%s`';

            $phpcs_file->addError(
                $error,
                $stack_ptr,
                'NonSnakecaseVariableFound',
                [$variable_name]
            );
        }
    }

    /**
     * Determine whether the variable is a PHP predefined variable.
     */
    protected function isPredefinedVariable(string $variable_name) : bool
    {
        return \in_array($variable_name, [
            '_SERVER',
            '_GET',
            '_POST',
            '_FILES',
            '_REQUEST',
            '_SESSION',
            '_ENV',
            '_COOKIE',
            'GLOBALS',
            'HTTP_RAW_POST_DATA',
        ], true);
    }
}
