<?php

namespace Sylake\Sylakim\Connector\Client;

use Pim\Component\Catalog\Model\AssociationTypeInterface;

interface AssociationTypeClientInterface
{
    /**
     * @param AssociationTypeInterface $associationType
     *
     * @return bool
     */
    public function exists(AssociationTypeInterface $associationType);

    /**
     * @param AssociationTypeInterface $associationType
     */
    public function create(AssociationTypeInterface $associationType);

    /**
     * @param AssociationTypeInterface $associationType
     */
    public function update(AssociationTypeInterface $associationType);
}
