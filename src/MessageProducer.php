<?php

namespace Luizalbertobm\Rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MessageProducer
{
    private $connection;
    private $channel;

    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('queue', false, false, false, false);
    }

    public function sendMessage($message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', 'queue');
        echo " [x] Sent '{$message}'\n";
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
