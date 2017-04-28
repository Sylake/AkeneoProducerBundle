<?php

namespace Sylake\Sylakim\Connector\Client;

interface AssociationTypeClientFactoryInterface
{
    /**
     * @param Url $url
     * @param string $publicId
     * @param string $secret
     *
     * @return ResourceClientInterface
     */
    public function create(Url $url, $publicId, $secret);
}
