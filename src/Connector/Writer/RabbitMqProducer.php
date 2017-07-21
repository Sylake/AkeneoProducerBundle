<?php

namespace Sylake\AkeneoProducerBundle\Connector\Writer;

use Akeneo\Component\Batch\Item\ItemWriterInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Sylake\AkeneoProducerBundle\Event\MessageEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class RabbitMqProducer implements ItemWriterInterface
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * @var string
     */
    private $messageType;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param ProducerInterface        $producer
     * @param                          $messageType
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ProducerInterface $producer, $messageType, EventDispatcherInterface $eventDispatcher)
    {
        $this->producer = $producer;
        $this->messageType = $messageType;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $items
     */
    public function write(array $items)
    {
        foreach ($items as $item) {
            $this->producer->publish(json_encode([
                'type' => $this->messageType,
                'payload' => $item,
                'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
            ]));

            $this->eventDispatcher->dispatch(
                MessageEvent::POST_PUBLISH,
                new MessageEvent($this->messageType, $item)
            );
        }
    }
}
