<?php declare(strict_types = 1);

namespace RaskCodingStandard\Tests\Util;

use PHPUnit\Framework\TestCase;
use RaskCodingStandard\Utils\SnakeCase;

/**
 * Class SnakeCaseTest
 */
class SnakeCaseTest extends TestCase
{
    public function test_it_validates_snake_case_properly()
    {
        $ok = [
            'helloworld',
            'hello_world',
            'hello2world2',
            'hello_2_world',
            'hello2_world_foobar'
        ];

        $fail = [
            'HelloWorld',
            'hello_World',
            '_hello_world',
            'helloworld_',
            'hello__world',
            'hello_____world',
            '2hello_world',
        ];

        foreach ($ok as $subject) {
            $this->assertTrue(SnakeCase::isSnakeCase($subject), $subject . ' was not valid');
        }

        foreach ($fail as $subject) {
            $this->assertFalse(SnakeCase::isSnakeCase($subject), $subject . ' was not invalid');
        }
    }
}
