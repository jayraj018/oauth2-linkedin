<?php

namespace Jayraj018\OAuth2LinkedIn;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class LinkedIn extends AbstractProvider
{
    use BearerAuthorizationTrait;

    protected $scopeSeparator = ' ';

    protected function getBaseAuthorizationUrl()
    {
        return 'https://www.linkedin.com/oauth/v2/authorization';
    }

    protected function getBaseAccessTokenUrl(array $params)
    {
        return 'https://www.linkedin.com/oauth/v2/accessToken';
    }

    protected function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.linkedin.com/v2/userinfo';
    }

    protected function getDefaultScopes()
    {
        return ['openid', 'profile', 'email'];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                $data['error_description'] ?? $data['message'],
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new LinkedInResourceOwner($response);
    }
}
