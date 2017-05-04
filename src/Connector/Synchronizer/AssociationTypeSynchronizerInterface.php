<?php

namespace Sylake\Sylakim\Connector\Synchronizer;

use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Sylake\Sylakim\Connector\Client\ResourceClientInterface;

interface AssociationTypeSynchronizerInterface
{
    /**
     * @param ResourceClientInterface $associationTypeClient
     * @param AssociationTypeInterface $associationType
     */
    public function synchronize(ResourceClientInterface $associationTypeClient, AssociationTypeInterface $associationType);
}
