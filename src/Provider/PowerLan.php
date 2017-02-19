<?php

namespace PowerLan\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Psr\Http\Message\ResponseInterface;

class PowerLan extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * {@inheritDoc}
     */
    public $authorizationHeader = "bearer";

    /**
     * {@inheritDoc}
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://sso.power-lan.com/oauth/authorize';
    }

    /**
     * {@inheritDoc}
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://sso.power-lan.com/oauth/token';
    }

    /**
     * {@inheritDoc}
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://sso.power-lan.com/oauth/UserInfo';
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultScopes()
    {
        return array();
    }

    /**
     * {@inheritDoc}
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() != 200) {
            $data = (is_array($data)) ? $data : json_decode($data, true);
            throw new IdentityProviderException($data['error_description'], $response->getStatusCode(), $data);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function createResourceOwner(array $response, AccessToken $token)
    {
        return $response;
    }
}
