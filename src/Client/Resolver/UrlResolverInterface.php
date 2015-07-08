<?php


namespace Sylake\Bundle\SylakimBundle\Client\Resolver;

interface UrlResolverInterface
{
    /**
     * @param string $resource
     * @param bool $suffixWithId
     * @param array  $params
     *
     * @return string
     */
    public function resolve($resource, array $params = [], $suffixWithId = false);
}