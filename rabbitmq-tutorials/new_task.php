<?php

require_once __DIR__ . '/../vendor/autoload.php';

// 连接 server
$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

// 创建一个名为 'hello' 的队列，已经存在就忽略
$channel->queue_declare('hello', false, false, false, false);

// 还是创建一条消息，消费端那边看 $data 有几个 . 消费耗时就几秒
$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = 'hello world!';
}
$msg = new \PhpAmqpLib\Message\AMQPMessage($data);

// 消息投递到名为 'hello' 的队列中
$channel->basic_publish($msg, '', 'hello');

echo " [x] sent $data \n";

$channel->close();
$connection->close();