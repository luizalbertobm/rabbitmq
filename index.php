<?php

use Luizalbertobm\Rabbitmq\MessageConsumer;
use Luizalbertobm\Rabbitmq\MessageProducer;
use PhpAmqpLib\Connection\AMQPStreamConnection;

require_once __DIR__ . '/vendor/autoload.php';

const PRODUCER = 1;
const CONSUMER = 2;

$message = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : null;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'password');

if($message) {
    $producer = new MessageProducer($connection);
    $producer->sendMessage($message);
    $producer->close();
} else {
    $consumer = new MessageConsumer($connection);
    $consumer->consumeMessages();
    $consumer->close();
}

// run the producer with the following command in terminal:
// docker-compose exec php php index.php 1

// run the consumer with the following command in terminal:
// docker-compose exec php php index.php 2