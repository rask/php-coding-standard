# rask/coding-standard

Opinionated PHP coding standard rules to be used with PHP_CodeSniffer.

## Installation

    $ composer require --dev rask/coding-standard
    
In your `phpcs.xml`:

    <config name="installed_paths" value="vendor/rask/coding-standard">
    
    <rule ref="RaskCodingStandard" />
    
## Sniffs

### RaskCodingStandard.NamingConventions.VariableNaming

Variable names must be `snake_case`, must contain only `a-z`, `0-9`, and `_`, must not begin or end with an underscore, and must not contain two consecutive underscores. This also applies to properties within classes.

OK:

    $hello_world_1_how_are_you2
    
ERROR:

    $hello__World_how_are_you_

## Todo

[ ] Add proper tests, the PHPCS test setup is wonky to use, maybe write a new one or copy from some place else

## License

MIT License. See [LICENSE.md](./LICENSE.md).
