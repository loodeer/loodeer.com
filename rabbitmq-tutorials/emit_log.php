<?php
require_once __DIR__ . '/../vendor/autoload.php';

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// 声明 exchange，广播类型 fanout
$channel->exchange_declare('logs', 'fanout', false, false, false);

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = 'info: hello world!';
}

$msg = new \PhpAmqpLib\Message\AMQPMessage($data);

$channel->basic_publish($msg, 'logs');

echo ' [x] Sent ' . $data . "\n";

$channel->close();
$connection->close();