<?php

require_once __DIR__ . '/../vendor/autoload.php';

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

// 由于消费脚本可能先于生产者启动，先 declare 下保证有 'hello' 队列
$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for message. To exit press CTRL+C\n";

// 定义消费回调函数
$callback = function ($msg) {
    echo ' [x] Received ' . $msg->body . "\n";
    sleep(substr_count($msg->body, '.')); // 消息里有几个 . 就消费几秒
    echo " [x] Done \n";
};

// 自定义的 callback 绑定到 channel 上
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}