<?php

namespace Sylake\Sylakim\Connector\Client;

use Sylius\Api\ApiInterface;

final class ResourceClient implements ResourceClientInterface
{
    /**
     * @var ApiInterface
     */
    private $associationTypeApi;

    /**
     * @param ApiInterface $associationTypeApi
     */
    public function __construct(ApiInterface $associationTypeApi)
    {
        $this->associationTypeApi = $associationTypeApi;
    }

    /**
     * {@inheritdoc}
     */
    public function exists($identifier)
    {
        $response = $this->associationTypeApi->get($identifier);

        // TODO: lakion/sylius-api-php does not provide any way to check whether a resource exists, hacky hack
        if (isset($response['code'], $response['message']) && count($response) === 2) {
            return $response['code'] !== 404;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $payload)
    {
        $this->associationTypeApi->create($payload);
    }

    /**
     * {@inheritdoc}
     */
    public function update($identifier, array $payload)
    {
        $this->associationTypeApi->update($identifier, $payload);
    }
}
