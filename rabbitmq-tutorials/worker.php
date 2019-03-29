<?php

require_once __DIR__ . '/../vendor/autoload.php';

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

// 由于消费脚本可能先于生产者启动，先 declare 下保证有 'hello' 队列。
// $channel->queue_declare('hello', false, false, false, false);

// 队列持久化
$channel->queue_declare('task_queue', false, true, false, false);

echo " [*] Waiting for message. To exit press CTRL+C\n";

// 定义消费回调函数
$callback = function ($msg) {
    echo ' [x] Received ' . $msg->body . "\n";
    sleep(substr_count($msg->body, '.')); // 消息里有几个 . 就消费几秒
    echo " [x] Done \n";
    // 下面修改 no_ack 参数后，还要加上这一行，进行 ack 通知，不然挂掉那个消费者上的所有消息都会被重新投递。
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

// 每次只预取一条消息。避免循环分发时会导致各个消费分组压力不一致。
$channel->basic_qos(null, 1, null);

// 自定义的 callback 绑定到 channel 上
// 第四个参数改为 false 表示需要 ack。rabbitmq 收到消费端的 ack 消息之后，才认为消息是被消费了。
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}