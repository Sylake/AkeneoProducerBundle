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
    public function create(Url $url, $publicId, $secret)
    {
        $oauth2Client = new GuzzleClient([
            'base_url' => 'http://localhost:8080',
        ]);

        $config = [
            'token_url' => 'api/oauth/v2/token',
            'client_id' => '13cdr011ecmscscgccss88gg8os04ggwo88o44ok00oww0csg4',
            'client_secret' => '2ohj2nvohruocc8wg0w08s4c4cgwco0ss0o4okgck4cogsck84',
            'username' => 'api@example.com',
            'password' => 'sylius-api'
        ];

        $token = new PasswordCredentials($oauth2Client, $config);
        $refreshToken = new RefreshToken($oauth2Client, $config);

        $oauth2 = new Oauth2Subscriber($token, $refreshToken);

        $syliusClient = Client::createFromUrl('http://localhost:8080/api/v1/', $oauth2);

        $apiResolver = new ApiResolver($syliusClient, new ArrayUriMap([]));

        return new ResourceClient($apiResolver->getApi('product-association-types'));
    }
}
