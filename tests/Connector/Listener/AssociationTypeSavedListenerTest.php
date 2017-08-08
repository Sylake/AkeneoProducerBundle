<?php

namespace Tests\Sylake\AkeneoProducerBundle\Connector\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Sylake\AkeneoProducerBundle\TraceableProducer;

final class AssociationTypeSavedListenerTest extends KernelTestCase
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var TraceableProducer */
    private $publisher;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        self::bootKernel();

        $this->objectManager = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->publisher = static::$kernel->getContainer()->get('app.producer.sylius_workshop_croatia');
    }
}
