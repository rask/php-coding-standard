<?php declare(strict_types = 1);

namespace RaskCodingStandard\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractScopeSniff;
use RaskCodingStandard\Utils\SnakeCase;

/**
 * Class FunctionNamingSniff
 *
 * Enforce snake_case bare function names.
 *
 * We use the AbstractScopeSniff inversely, ignore scope innards and only process the outside.
 */
class FunctionNamingSniff extends AbstractScopeSniff
{
    /**
     * FunctionNamingSniff constructor.
     *
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException On empty token array.
     */
    public function __construct()
    {
        // Method names exist inside the following. Allow processing outside as well to reach
        // loose functions.
        parent::__construct([T_CLASS, T_TRAIT, T_INTERFACE, T_ENUM], [T_FUNCTION], true);
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
    protected function processFunctionName(File $phpcs_file, mixed $stack_ptr) : void
    {
        $tokens = $phpcs_file->getTokens();

        // 99.999% of the time the function name comes right after the `function` keyword.
        $function_name_token = $tokens[$stack_ptr + 2];
        $function_name = $function_name_token['content'];

        if (SnakeCase::isSnakeCase($function_name) === false) {
            $error = 'Function names must be snake_case and consist only of a-z, 0-9, and _ characters, '
                . 'and cannot start or end with a _ character, or contain two adjacent _ '
                . 'characters, found `%s`';

            $phpcs_file->addError($error, $stack_ptr + 2, 'NonSnakecaseVariableFound', [$function_name]);
        }
    }
    /**
     * Processes a token that is found within the scope that this test is listening to.
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration
     *
     * @param File $phpcs_file The file where this token was found.
     * @param mixed $stack_ptr The position in the stack where this token was found.
     * @param mixed $curr_scope The position in the tokens array that opened the scope that this
     *                          test is listening for.
     */
    protected function processTokenWithinScope(File $phpcs_file, mixed $stack_ptr, mixed $curr_scope) : void
    {
        // noop
    }

    /**
     * Processes a token that is found outside the scope that this test is listening to.
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration
     *
     * @param File $phpcs_file The file where this token was found.
     * @param mixed $stack_ptr The position in the stack where this token was found.
     */
    protected function processTokenOutsideScope(File $phpcs_file, mixed $stack_ptr) : void
    {
        $this->processFunctionName($phpcs_file, $stack_ptr);
    }
}
