<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector\Writer;

use Akeneo\Component\Batch\Item\ItemWriterInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Connector\Writer\RabbitMqProduct;
use PhpSpec\ObjectBehavior;

final class RabbitMqItemWriterSpec extends ObjectBehavior
{
    function let(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer, 'message_type');
    }

    function it_is_an_akeneo_writer()
    {
        $this->shouldImplement(ItemWriterInterface::class);
    }

    function it_publishes_product_created_events(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer, 'message_type');

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => [
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
            ],
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            [
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
            ],
        ]);
    }

    function it_publishes_association_type_created_event(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer, 'message_type');

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => [
                'code' => 'X_SELL',
                'labels' => [
                    'en_US' => 'Cross sell',
                    'fr_FR' => 'Vente croisée',
                ],
            ],
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            [
                'code' => 'X_SELL',
                'labels' => [
                    'en_US' => 'Cross sell',
                    'fr_FR' => 'Vente croisée',
                ],
            ],
        ]);
    }

    function it_publishes_category_created_event(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer, 'message_type');

        $producer->publish(json_encode([
            'type' => 'message_type',
            'payload' => [
                'code' => 'master',
                'parent' => null,
                'labels' => [
                    'en_US' => 'Master catalog',
                    'de_DE' => 'Hauptkatalog',
                    'fr_FR' => 'Catalogue principal'
                ],
            ],
            'recordedOn' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]))->shouldBeCalled();

        $this->write([
            [
                'code' => 'master',
                'parent' => null,
                'labels' => [
                    'en_US' => 'Master catalog',
                    'de_DE' => 'Hauptkatalog',
                    'fr_FR' => 'Catalogue principal'
                ],
            ],
        ]);
    }

    function it_does_not_publish_events_if_there_is_nothing_to_publish(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer, 'message_type');
        $producer->publish(Argument::any())->shouldNotBeCalled();

        $this->write([]);
    }
}
