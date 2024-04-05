<?php
namespace Luizalbertobm\Rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class MessageConsumer {
    private $connection;
    private $channel;
    private $queue;
    private $count = 0;

    public function __construct(AMQPStreamConnection $connection) {
        $this->connection = $connection;
        $this->channel = $this->connection->channel();
        $this->queue = $this->channel->queue_declare('queue', false, false, false, false);
    }

    public function consumeMessages() {
        
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
        echo " [*] Queue '{$this->queue[0]}' has {$this->queue[1]} messages\n";
        
        $this->channel->basic_consume('queue', '', false, true, false, false, function ($msg) {
            sleep(3); // simulate a slow consumer
            $this->count++;
            echo " [{$this->count}] Received: ", $msg->body, "\n";
        });
        
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function close() {
        $this->channel->close();
        $this->connection->close();
    }
}