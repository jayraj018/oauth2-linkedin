<?php

namespace Jayraj018\OAuth2LinkedIn;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class LinkedInResourceOwner implements ResourceOwnerInterface
{
    protected $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->response['sub'] ?? null;
    }

    public function toArray()
    {
        return $this->response;
    }
}
