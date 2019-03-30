<?php

include_once __DIR__ . '/../vendor/autoload.php';

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = 'hello world!';
}

$msg = new \PhpAmqpLib\Message\AMQPMessage($data);

// 第三个参数指定 exchange 里面的 routing key，queue 绑定 exchange 时，可以选择指定 routing key 的消息
$channel->basic_publish($msg, 'topic_logs', $severity);

echo ' [x] Sent ' . $severity . ':' . $data . '\n';

$channel->close();
$connection->close();