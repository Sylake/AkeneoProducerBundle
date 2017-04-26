<?php

namespace Sylake\Sylakim\Connector\Client;

use Pim\Component\Catalog\Model\AssociationTypeInterface;

interface AssociationTypeClientInterface
{
    /**
     * @param AssociationTypeInterface $associationType
     */
    public function synchronize(AssociationTypeInterface $associationType);
}
