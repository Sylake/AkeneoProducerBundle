AkeneoProducerBundle
====================

Makes Akeneo produce AMQP messages pushed through RabbitMQ.

Installation
------------

1. Require this package:

```bash
$ composer require sylake/akeneo-producer-bundle
```

2. Add bundles to `AppKernel.php` of existing Akeneo application:

```php
protected function registerProjectBundles()
{
    return [
        new \OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
        new \Sylake\AkeneoProducerBundle\SylakeAkeneoProducerBundle(),
    ];
}
```

Usage
-----

1. Perform export via UI or CLI:

```bash
$ app/console akeneo:batch:create-job "Sylake - Akeneo Producer" sylake_akeneo_producer export sylake_akeneo_producer
$ app/console akeneo:batch:job sylake_akeneo_producer
```
