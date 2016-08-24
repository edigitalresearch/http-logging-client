<?php

namespace edr\LoggingHttpClient;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request\Serializer as RequestSerializer;
use Zend\Diactoros\Response\Serializer as ResponseSerializer;

/**
 * A message formatter that uses serialisation methods in Zend's Diactoros PSR7 library.
 */
class DiactorosFormatter implements MessageFormatter
{
    /**
     * @inheritdoc
     */
    public function formatRequest(RequestInterface $request)
    {
        return RequestSerializer::toString($request);
    }
    
    /**
     * @inheritdoc
     */
    public function formatResponse(ResponseInterface $response)
    {
        return ResponseSerializer::toString($response);
    }
}
