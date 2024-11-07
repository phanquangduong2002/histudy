<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Queue;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;


class SendRabbitMQNotification
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageData;

    public function __construct(array $messageData)
    {
        $this->messageData = $messageData;
    }

    public function handle(): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', '127.0.0.1'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', '12345'),
            env('RABBITMQ_VHOST', '/')
        );

        $channel = $connection->channel();
        $queue = env('RABBITMQ_QUEUE', 'notifications');

        $channel->queue_declare($queue, false, true, false, false);

        // Encode message data to JSON
        $msg = new AMQPMessage(json_encode($this->messageData));
        $channel->basic_publish($msg, '', $queue);

        $channel->close();
        $connection->close();
    }
}