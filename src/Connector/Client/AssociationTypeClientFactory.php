<?php

namespace Sylake\Sylakim\Connector\Client;

final class AssociationTypeClientFactory implements AssociationTypeClientFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(Url $url, $publicId, $secret)
    {
        return new AssociationTypeClient($url, $publicId, $secret);
    }
}
