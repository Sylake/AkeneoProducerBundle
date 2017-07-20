<?php

namespace Sylake\AkeneoProducerBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends Event
{
    const POST_PUBLISH = 'akeneo_producer_message.post_publish';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $payload;

    /**
     * @param string $type
     * @param mixed $payload
     */
    public function __construct(string $type, $payload)
    {
        $this->type = $type;
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
