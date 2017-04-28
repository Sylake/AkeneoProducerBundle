<?php

namespace Sylake\Sylakim\Connector\Client;

interface ResourceClientInterface
{
    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function exists($identifier);

    /**
     * @param array $payload
     */
    public function create(array $payload);

    /**
     * @param string $identifier
     * @param array $payload
     */
    public function update($identifier, array $payload);
}
