<?php

namespace App\Tests\Unit\Application\Adapters\Http\Response;

use App\Domain\Greeting\Greeting;
use App\Tests\Util\DataProvider\GreetingDataProvider;
use App\UI\Http\Response\GreetingResponse;
use PHPUnit\Framework\TestCase;

class GreetingResponseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateResponse(): void
    {
        $name     = 'Dominik';
        $greeting = Greeting::fromName($name);
        $expected = GreetingDataProvider::createResponseJson($name);
        $actual   = GreetingResponse::fromGreeting($greeting);

        self::assertEquals($expected, $actual->getContent());
    }
}
