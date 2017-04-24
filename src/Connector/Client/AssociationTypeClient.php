<?php

namespace Sylake\Sylakim\Connector\Client;

use Pim\Component\Catalog\Model\AssociationTypeInterface;

final class AssociationTypeClient implements AssociationTypeClientInterface
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var string
     */
    private $publicId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @param Url $url
     * @param string $publicId
     * @param string $secret
     */
    public function __construct(Url $url, $publicId, $secret)
    {
        $this->url = $url;
        $this->publicId = $publicId;
        $this->secret = $secret;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(AssociationTypeInterface $associationType)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function create(AssociationTypeInterface $associationType)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function update(AssociationTypeInterface $associationType)
    {

    }
}
