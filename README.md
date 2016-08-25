# logging-http-client
An [HTTPlug](http://httplug.io/) client that logs to a [PSR3](http://www.php-fig.org/psr/psr-3/) logger.

This performs the same function as the [HTTPlug plugin](http://docs.php-http.org/en/latest/plugins/logger.html). This 
can be used as an alternative if you need more control of the logging options.

Example usage with [Guzzle](http://docs.guzzlephp.org/en/latest/) and [Monolog](https://github.com/Seldaek/monolog):

```php
$client = new \edr\LoggingHttpClient\LoggingHttpClient(
    new \Http\Adapter\Guzzle6\Client(new \GuzzleHttp\Client()),
    new \Monolog\Logger('debug', new \Monolog\Handler\StreamHandler('/tmp/debug.log')),
    new \edr\LoggingHttpClient\DiactorosFormatter()
);

$client->sendRequest( ... );
```
