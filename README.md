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

3. Configure RabbitMQ default connection:

```yaml
# app/config/config.yml

old_sound_rabbit_mq:
    connections:
        default:
            host: 'localhost'
            port: 5672
            user: 'guest'
            password: 'guest'
```

4. Configure locales (optional) (default: en_GB, de_DE):

```yaml
# app/config/config.yml

sylake_akeneo_producer:
    locales:
        - 'en_GB'
        - 'de_DE'
```

Usage
-----

1. Perform export via UI or CLI:

```bash
$ app/console akeneo:batch:create-job "Sylake - Akeneo Producer" sylake_akeneo_producer export sylake_akeneo_producer
$ app/console akeneo:batch:job sylake_akeneo_producer
```

You can also export just one product by its SKU by running:

```bash
$ app/console sylake:producer:export-product PRODUCT_SKU
```
