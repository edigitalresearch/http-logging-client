# logging-http-client
An [HTTPlug](http://httplug.io/) client that logs to a [PSR3](http://www.php-fig.org/psr/psr-3/) logger.

Example usage:

```php
$client = new \edr\LoggingHttpClient\LoggingHttpClient(
    /* TODO */,
    /* TODO */,
    new \edr\LoggingHttpClient\DiactorosFormatter()
);

$client->sendRequest( ... );
```

Message formatting inspired by [log-http-messages](https://github.com/php-middleware/log-http-messages).
