<?php

namespace Marshmallow\GTMetrix;

use Entrecore\GTMetrixClient\GTMetrixClient as BaseGTMetrixClient;

class GTMetrixClient extends BaseGTMetrixClient
{
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
