# logging-http-client
An [HTTPlug](http://httplug.io/) client that logs to a PSR3 logger.

Example usage:

```php
$client = new \edr\LoggingHttpClient\LoggingHttpClient(
    /* TODO */,
    /* TODO */,
    new \edr\LoggingHttpClient\DiactorosFormatter()
);

$client->sendRequest( ... );
```
