<?php

namespace League\OAuth2\Client\Provider;

class LinkedIn extends AbstractProvider
{
    protected $baseAuthorizationUrl = 'https://www.linkedin.com/oauth/v2/authorization';
    protected $baseAccessTokenUrl = 'https://www.linkedin.com/oauth/v2/accessToken';
    protected $resourceOwnerDetailsUrl = 'https://api.linkedin.com/v2/me';

    protected function getDefaultScopes()
    {
        return ['r_liteprofile', 'r_emailaddress'];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    protected function checkResponse($response, $data)
    {
        if (isset($data['serviceErrorCode'])) {
            throw new IdentityProviderException(
                $data['message'] ?? $response->getReasonPhrase(),
                $data['serviceErrorCode'],
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new LinkedInResourceOwner($response);
    }
}
