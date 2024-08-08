<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\SocketHandler;

class CreateLogstashLogger
{
    public function __invoke(array $config)
    {
        $log = new Logger('logstash');
        $log->pushHandler(new SocketHandler('tcp://localhost:5044', Logger::DEBUG));
        return $log;
    }
}