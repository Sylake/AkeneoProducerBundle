<?php

namespace Tests\Sylake\AkeneoProducerBundle;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

final class TraceableProducer implements ProducerInterface
{
    /** @var ProducerInterface */
    private $decoratedProducer;

    /** @var boolean */
    private $tracing = false;

    /** @var array */
    private $producedMessages = [];

    public function __construct(ProducerInterface $decoratedProducer)
    {
        $this->decoratedProducer = $decoratedProducer;
    }

    /** {@inheritdoc} */
    public function publish($msgBody, $routingKey = '', $additionalProperties = [])
    {
        $this->decoratedProducer->publish($msgBody, $routingKey, $additionalProperties);

        if ($this->tracing) {
            $this->producedMessages[] = $msgBody;
        }
    }

    public function startTracing()
    {
        $this->tracing = true;
    }

    public function stopTracing()
    {
        $this->tracing = false;
    }

    public function getProducedMessages()
    {
        $producedMessages = $this->producedMessages;

        $this->producedMessages = [];

        return $producedMessages;
    }
}
