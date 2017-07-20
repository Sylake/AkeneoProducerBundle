<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector\Writer;

use Akeneo\Component\Batch\Item\ItemWriterInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Connector\Writer\RabbitMqProduct;
use PhpSpec\ObjectBehavior;
use Sylake\AkeneoProducerBundle\Event\MessageEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class RabbitMqProducerSpec extends ObjectBehavior
{
    function let(ProducerInterface $producer, EventDispatcherInterface $eventDispatcher)
    {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);
    }

    function it_is_an_akeneo_writer()
    {
        $this->shouldImplement(ItemWriterInterface::class);
    }

    function it_publishes_product_created_events(ProducerInterface $producer, EventDispatcherInterface $eventDispatcher)
    {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);

        $item = [
                'identifier' => 'AKNTS_BPXS',
                'categories' => ['goodies', 'tshirts'],
                'values' => [
                    'sku' => [['locale' => null, 'scope' => null]],
                    'clothing_size' => [['locale' => null, 'scope' => null, 'data' => 'xs']],
                    'description' => [['locale' => null, 'scope' => null, 'data' => 'Akeneo T-Shirt']],
                    'tshirt_materials' => [['locale' => null, 'scope' => null, 'data' => 'cotton']],
                    'tshirt_style' => [['locale' => null, 'scope' => null, 'data' => ['crewneck', 'short_sleeve']]],
                ],
                'created' => '2017-05-04T12:58:07+00:00',
                'associations' => [
                    'SUBSTITUTION' => [
                        'groups' => [],
                        'products' => [
                            'AKNTS_WPXS',
                            'AKNTS_PBXS',
                            'AKNTS_PWXS',
                        ],
                    ],
                ],
                'price' => [
                    [
                        'locale' => null,
                        'scope' => 'channel1',
                        'data' => [['amount' => 10, 'currency' => 'EUR']],
                    ],
                    [
                        'locale' => null,
                        'scope' => 'channel2',
                        'data' => [['amount' => 20, 'currency' => 'USD']],
                    ],
                ],
            ];


        $eventDispatcher
            ->dispatch('akeneo_producer_message.post_publish', new MessageEvent('message_type', $item))
            ->shouldBeCalled();

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => $item,
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            $item,
        ]);
    }

    function it_publishes_association_type_created_event(
        ProducerInterface $producer,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);

        $item = [
                'code' => 'X_SELL',
                'labels' => [
                    'en_US' => 'Cross sell',
                    'fr_FR' => 'Vente croisée',
                ],
            ];

        $eventDispatcher
            ->dispatch('akeneo_producer_message.post_publish', new MessageEvent('message_type', $item))
            ->shouldBeCalled();

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => $item,
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            $item,
        ]);
    }

    function it_publishes_category_created_event(ProducerInterface $producer, EventDispatcherInterface $eventDispatcher)
    {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);

        $item = [
                'code' => 'master',
                'parent' => null,
                'labels' => [
                    'en_US' => 'Master catalog',
                    'de_DE' => 'Hauptkatalog',
                    'fr_FR' => 'Catalogue principal'
                ],
            ];

        $eventDispatcher
            ->dispatch('akeneo_producer_message.post_publish', new MessageEvent('message_type', $item))
            ->shouldBeCalled();

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => $item,
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            $item,
        ]);
    }

    function it_does_not_publish_events_if_there_is_nothing_to_publish(
        ProducerInterface $producer,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);
        $producer->publish(Argument::any())->shouldNotBeCalled();
        $eventDispatcher->dispatch(Argument::any())->shouldNotBeCalled();

        $this->write([]);
    }

    function it_should_dispatch_a_message_for_every_item_published(
        ProducerInterface $producer,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($producer, 'message_type', $eventDispatcher);

        $item = [
            'code' => 'master',
            'parent' => null,
            'labels' => [
                'en_US' => 'Master catalog',
                'de_DE' => 'Hauptkatalog',
                'fr_FR' => 'Catalogue principal'
            ],
        ];

        $items = [
            $item,
            $item,
            $item,
            $item,
        ];

        $itemsCount = count($items);

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => $item,
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalledTimes($itemsCount);

        $eventDispatcher
            ->dispatch('akeneo_producer_message.post_publish', new MessageEvent('message_type', $item))
            ->shouldBeCalledTimes($itemsCount);

        $this->write($items);
    }
}
