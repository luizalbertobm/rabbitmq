# RabbitMQ Message Producer and Consumer Example

This project demonstrates a simple implementation of a message producer and consumer using RabbitMQ in PHP.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- Docker
- Docker Compose

### Installation

1. Clone the repository
2. Navigate to the project directory
3. Run `docker-compose up -d` to start the services

## Usage

### Running the Producer

To run the producer, execute the following command in your terminal how many times you want. You also can change the message each time.

```bash
docker-compose exec php php index.php "my message"
docker-compose exec php php index.php "other message"
docker-compose exec php php index.php "one more message"
```

This will send a 'Hello World!' message to the queue.

### Running the Consumer
To run the consumer, execute the following command in your terminal:
```bash
docker-compose exec php php index.php
```

This will consume the message from the queue.

## License
This project is licensed under the MIT License - see the LICENSE.md file for details