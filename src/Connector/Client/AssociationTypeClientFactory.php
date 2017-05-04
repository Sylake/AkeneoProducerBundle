<?php

namespace Sylake\Sylakim\Connector\Client;

use CommerceGuys\Guzzle\Oauth2\GrantType\PasswordCredentials;
use CommerceGuys\Guzzle\Oauth2\GrantType\RefreshToken;
use CommerceGuys\Guzzle\Oauth2\Oauth2Subscriber;
use GuzzleHttp\Client as GuzzleClient;
use Sylius\Api\ApiResolver;
use Sylius\Api\Client;
use Sylius\Api\Map\ArrayUriMap;

final class AssociationTypeClientFactory implements AssociationTypeClientFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(Url $apiUrl, $apiPublicId, $apiSecret, $adminLogin, $adminPassword)
    {
        $oauth2Client = new GuzzleClient([
            'base_url' => (string) $apiUrl,
        ]);

        $config = [
            'token_url' => 'oauth/v2/token',
            'client_id' => $apiPublicId,
            'client_secret' => $apiSecret,
            'username' => $adminLogin,
            'password' => $adminPassword,
        ];

        $token = new PasswordCredentials($oauth2Client, $config);
        $refreshToken = new RefreshToken($oauth2Client, $config);

        $oauth2 = new Oauth2Subscriber($token, $refreshToken);

        $syliusClient = Client::createFromUrl((string) $apiUrl . '/v1/', $oauth2);

        $apiResolver = new ApiResolver($syliusClient, new ArrayUriMap([]));

        return new ResourceClient($apiResolver->getApi('product-association-types'));
    }
}
