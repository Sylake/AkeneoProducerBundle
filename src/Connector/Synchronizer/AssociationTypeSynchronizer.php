<?php

namespace Sylake\Sylakim\Connector\Synchronizer;

use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Pim\Component\Catalog\Model\AssociationTypeTranslationInterface;
use Sylake\Sylakim\Connector\Client\ResourceClientInterface;

final class AssociationTypeSynchronizer implements AssociationTypeSynchronizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function synchronize(ResourceClientInterface $associationTypeClient, AssociationTypeInterface $associationType)
    {
        if ($associationTypeClient->exists($associationType->getCode())) {
            $associationTypeClient->update($associationType->getCode(), $this->getUpdatePayload($associationType));

            return;
        }

        $associationTypeClient->create($this->getCreatePayload($associationType));
    }

    /**
     * @param AssociationTypeInterface $associationType
     *
     * @return array
     */
    private function getCreatePayload(AssociationTypeInterface $associationType)
    {
        return array_merge(
            ['code' => $associationType->getCode()],
            $this->getUpdatePayload($associationType)
        );
    }

    /**
     * @param AssociationTypeInterface $associationType
     *
     * @return array
     */
    private function getUpdatePayload(AssociationTypeInterface $associationType)
    {
        $payload = [];

        foreach ($associationType->getTranslations() as $associationTypeTranslation) {
            /** @var AssociationTypeTranslationInterface $associationTypeTranslation */
            $payload['translations'][$associationTypeTranslation->getLocale()] = [
                'name' => $associationTypeTranslation->getLabel(),
            ];
        }

        return $payload;
    }
}
