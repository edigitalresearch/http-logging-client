<?php

namespace edr\LoggingHttpClientTests;

use edr\LoggingHttpClient\LoggingHttpClient;
use edr\LoggingHttpClient\MessageFormatter;
use Http\Client\HttpClient;
use Http\Message\Formatter;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoggingHttpClientTest extends TestCase 
{
    public function testSendRequest()
    {
        $request  = $this->getMockRequest();
        $response = $this->getMockResponse();
        
        $client = new LoggingHttpClient(
            $this->getMockClient($request, $response),
            $this->getMockLogger([
                [LogLevel::INFO, sprintf('Sending HTTP request:%sfoo', PHP_EOL), []],
                [LogLevel::INFO, sprintf('Received HTTP response:%sbar', PHP_EOL), []],
            ]),
            $this->getMockFormatter($request, 'foo', $response, 'bar')
        );
        
        $client->sendRequest($request);
    }
    
    public function provideSendRequestExpectations()
    {
        return [
            [$this->getMockRequest(), $this->getMockResponse()],
        ];
    }
    
    /**
     * @return HttpClient
     */
    private function getMockClient(RequestInterface $expectedRequest, ResponseInterface $response)
    {
        $client = $this->getMockForAbstractClass(HttpClient::class);
        
        $client->expects($this->once())
            ->method('sendRequest')
            ->with($expectedRequest)
            ->willReturn($response);
        
        return $client;
    }
    
    /**
     * @return LoggerInterface
     */
    private function getMockLogger(array $expectedLogs)
    {
        $logger = $this->getMockForAbstractClass(LoggerInterface::class);
        
        $logger->expects($this->exactly(count($expectedLogs)))
            ->method('log')
            ->withConsecutive(...$expectedLogs);
            
        return $logger;
    }
    
    /**
     * @return RequestInterface
     */
    private function getMockRequest()
    {
        return $this->getMockForAbstractClass(RequestInterface::class);
    }
    
    /**
     * @return ResponseInterface
     */
    private function getMockResponse()
    {
        return $this->getMockForAbstractClass(ResponseInterface::class);
    }
    
    /**
     * @return Formatter
     */
    private function getMockFormatter(RequestInterface $request, $requestString, ResponseInterface $response, $responseString)
    {
        $formatter = $this->getMockForAbstractClass(Formatter::class);
        
        $formatter->expects($this->once())
            ->method('formatRequest')
            ->with($request)
            ->willReturn($requestString);
        
        $formatter->expects($this->once())
            ->method('formatResponse')
            ->with($response)
            ->willReturn($responseString);
        
        return $formatter;
    }
}
