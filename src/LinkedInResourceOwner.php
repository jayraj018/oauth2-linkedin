<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class LinkedInResourceOwner implements ResourceOwnerInterface
{
    private $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->response['id'] ?? null;
    }

    public function toArray()
    {
        return $this->response;
    }
}
