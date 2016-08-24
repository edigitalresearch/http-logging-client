<?php

namespace edr\LoggingHttpClient;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MessageFormatter
{
    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    public function formatRequest(RequestInterface $request);
    
    /**
     * @param ResponseInterface $response
     *
     * @return string
     */
    public function formatResponse(ResponseInterface $response);
}
