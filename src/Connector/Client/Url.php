<?php

namespace Sylake\Sylakim\Connector\Client;

final class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     */
    private function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $url
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public static function fromString($url)
    {
        if (!is_string($url)) {
            throw new \InvalidArgumentException('URL was expected to be a string');
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('The provided URL is invalid');
        }

        return new self($url);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}
