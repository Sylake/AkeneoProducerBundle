<?php

namespace Sylake\Bundle\SylakimBundle\Client\Adapter;

use Guzzle\Http\ClientInterface;
use Sylake\Bundle\SylakimBundle\Client\Resolver\UrlResolver;
use Sylake\Bundle\SylakimBundle\Client\Resolver\UrlResolverInterface;

class GuzzleAdapter implements ClientAdapterInterface
{
    /** @var ClientInterface  */
    private $client;
    /** @var UrlResolver  */
    private $urlResolver;

    public function __construct(ClientInterface $client, UrlResolverInterface $urlResolver)
    {
        $this->client = $client;
        $this->urlResolver = $urlResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function get($resource, array $params = [])
    {
        $url = $this->urlResolver->resolve($resource, $params);

        return $this->client->get($url);
    }

    /**
     * {@inheritdoc}
     */
    public function create($resource, array $params = [])
    {
        $url = $this->urlResolver->resolve($resource, $params);

        return $this->client->post($url, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function update($resource, array $params = [])
    {
        $url = $this->urlResolver->resolve($resource, $params);

        return $this->client->put($url, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($resource, array $params = [])
    {
        $url = $this->urlResolver->resolve($resource, $params);

        return $this->client->delete($url);
    }
}
