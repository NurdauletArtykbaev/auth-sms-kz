<?php
namespace NurdauletArtykbaev\CoreAuth\Test;

use NurdauletArtykbaev\CoreAuth\ExampleService;
use PHPUnit\Framework\TestCase;

class AuthOtpTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_some_result()
    {
        $sut = new ExampleService;
        $this->assertEquals('bar', $sut->getSomeResult());
    }
}