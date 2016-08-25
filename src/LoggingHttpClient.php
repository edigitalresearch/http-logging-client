<?php

namespace edr\LoggingHttpClient;

use Http\Client\HttpClient;
use Http\Message\Formatter;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;

/**
 * An HTTP client that logs via a PSR3 logger when an HTTP request/response is sent/received.
 */
final class LoggingHttpClient implements HttpClient
{
    /**
     * @var HttpClient
     */
    private $client;
    
    /**
     * @var LoggerInterface
     */
    private $logger;
    
    /**
     * @var Formatter
     */
    private $formatter;
    
    /**
     * @var LogOptions
     */
    private $options;
    
    public function __construct(
        HttpClient $client,
        LoggerInterface $logger,
        Formatter $formatter,
        LogOptions $options = null
    ) {
        $this->client    = $client;
        $this->logger    = $logger;
        $this->formatter = $formatter;
        $this->options   = $options ?: new LogOptions();
    }
    
    /**
     * @inheritdoc
     */
    public function sendRequest(RequestInterface $request)
    {
        $this->log($this->options->getSendPrefix() . $this->formatter->formatRequest($request));
        $response = $this->client->sendRequest($request);
        $this->log($this->options->getReceivedPrefix() . $this->formatter->formatResponse($response));
        
        return $response;
    }
    
    private function log($message)
    {
        $this->logger->log($this->options->getLogLevel(), $message, $this->options->getContext());
    }
}
