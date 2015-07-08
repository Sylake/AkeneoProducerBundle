<?php

namespace Sylake\Bundle\SylakimBundle\Client\Resolver;

use Sylake\Bundle\SylakimBundle\Client\Exception\UnknownResourceException;

class UrlResolver implements UrlResolverInterface
{
    /** @var array */
    private $mapping;

    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($resource, array $params = [], $suffixWithId = false)
    {
        if (!isset($this->mapping[$resource])) {
            throw new UnknownResourceException($resource);
        }

        $urlPattern = $this->mapping[$resource];
        if ($suffixWithId) {
            $urlPattern = $this->sufixWithId($urlPattern);
        }

        return $this->replaceVarsInUrl($urlPattern, $params);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    protected function sufixWithId($url)
    {
        $url = '/' === substr($url, -1) ? $url : $url.'/';
        $url.= '{id}';

        return $url;
    }

    /**
     * @param $urlPattern
     * @param $params
     *
     * @return string
     */
    protected function replaceVarsInUrl($urlPattern, $params)
    {
        foreach ($params as $name => $value) {
            $var = '{'.$name.'}';
            if (strpos($urlPattern, $var)) {
                $urlPattern = str_replace($var, $value, $urlPattern);
            }
        }

        return $urlPattern;
    }
}
