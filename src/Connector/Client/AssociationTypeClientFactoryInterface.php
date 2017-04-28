<?php

namespace Sylake\Sylakim\Connector\Client;

interface AssociationTypeClientFactoryInterface
{
    /**
     * @param Url $apiUrl
     * @param string $apiPublicId
     * @param string $apiSecret
     * @param string $adminLogin
     * @param string $adminPassword
     *
     * @return ResourceClientInterface
     *
     */
    public function create(Url $apiUrl, $apiPublicId, $apiSecret, $adminLogin, $adminPassword);
}
