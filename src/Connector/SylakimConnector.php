<?php

namespace Sylake\Sylakim\Connector;

use Akeneo\Component\Batch\Job\JobInterface;
use Akeneo\Component\Batch\Job\JobParameters\ConstraintCollectionProviderInterface;
use Akeneo\Component\Batch\Job\JobParameters\DefaultValuesProviderInterface;
use Pim\Component\Connector\Validator\Constraints\FilterData;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

final class SylakimConnector implements DefaultValuesProviderInterface, ConstraintCollectionProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultValues()
    {
        return [
            'api_url' => null,
            'api_public_id' => null,
            'api_secret' => null,
            'admin_login' => null,
            'admin_password' => null,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getConstraintCollection()
    {
        return new Collection(['fields' => [
            'api_url' => [
                new NotBlank(['groups' => 'Execution']),
                new Url(['groups' => 'Execution']),
            ],
            'api_public_id' => [
                new NotBlank(['groups' => 'Execution']),
            ],
            'api_secret' => [
                new NotBlank(['groups' => 'Execution']),
            ],
            'admin_login' => [
                new NotBlank(['groups' => 'Execution']),
            ],
            'admin_password' => [
                new NotBlank(['groups' => 'Execution']),
            ],
        ]]);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(JobInterface $job)
    {
        return $job->getName() === 'sylake_sylakim';
    }
}
