<?php

namespace edr\LoggingHttpClientTests;

use edr\LoggingHttpClient\LogOptions;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class LogOptionsTest extends TestCase 
{
    /**
     * @dataProvider provideNotOrEmptyStrings
     */
    public function testValidatesLogLevel($notString)
    {
        $this->expectException(\InvalidArgumentException::class);
        new LogOptions($notString);
    }
    
    /**
     * @dataProvider provideNotStrings
     */
    public function testValidatesSendMessage($notString)
    {
        $this->expectException(\InvalidArgumentException::class);
        new LogOptions(LogLevel::INFO, [], $notString);
    }
    
    /**
     * @dataProvider provideNotStrings
     */
    public function testValidatesReceivedMessage($notString)
    {
        $this->expectException(\InvalidArgumentException::class);
        new LogOptions(LogLevel::INFO, [], 'foo', $notString);
    }
    
    public function provideNotStrings()
    {
        return [
            [1],
            [0.1],
            [true],
            [new \stdClass()],
            [['foo']],
            [null],
        ];
    }
    
    public function provideNotOrEmptyStrings()
    {
        return array_merge($this->provideNotStrings(), [['']]);
    }
}
