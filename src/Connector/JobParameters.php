<?php

namespace Sylake\Sylakim\Connector;

use Akeneo\Component\Batch\Job\JobInterface;
use Akeneo\Component\Batch\Job\JobParameters\ConstraintCollectionProviderInterface;
use Akeneo\Component\Batch\Job\JobParameters\DefaultValuesProviderInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

final class JobParameters implements DefaultValuesProviderInterface, ConstraintCollectionProviderInterface
{
    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiPublicId;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @param string $apiUrl
     * @param string $apiPublicId
     * @param string $apiSecret
     */
    public function __construct($apiUrl, $apiPublicId, $apiSecret)
    {
        $this->apiUrl = $apiUrl;
        $this->apiPublicId = $apiPublicId;
        $this->apiSecret = $apiSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultValues()
    {
        return [
            'api_url' => $this->apiUrl,
            'api_public_id' => $this->apiPublicId,
            'api_secret' => $this->apiSecret,
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
