<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

final class StartupTests extends TestCase
{
    public function test()
    {
        $test = "hello";
        $this->assertEquals('hello', $test);
    }
}