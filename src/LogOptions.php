<?php

namespace edr\LoggingHttpClient;

use Psr\Log\LogLevel;

class LogOptions
{
    /**
     * @var string
     */
    private $logLevel;
    
    /**
     * @var array
     */
    private $context;
    
    /**
     * @var string
     */
    private $sendPrefix;
    
    /**
     * @var string
     */
    private $receivedPrefix;
    
    public function __construct(
        $logLevel = LogLevel::INFO,
        array $context = [],
        $sendPrefix = 'Sending HTTP request:' . PHP_EOL,
        $receivedPrefix = 'Received HTTP response:' . PHP_EOL
    ) {
        \Assert\that($logLevel)->string()->minLength(1);
        \Assert\that($sendPrefix)->string();
        \Assert\that($receivedPrefix)->string();
        
        $this->logLevel       = $logLevel;
        $this->context        = $context;
        $this->sendPrefix     = $sendPrefix;
        $this->receivedPrefix = $receivedPrefix;
    }
    
    /**
     * @return string
     */
    public function getLogLevel()
    {
        return $this->logLevel;
    }
    
    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }
    
    /**
     * @return string
     */
    public function getSendPrefix()
    {
        return $this->sendPrefix;
    }
    
    /**
     * @return string
     */
    public function getReceivedPrefix()
    {
        return $this->receivedPrefix;
    }
}
