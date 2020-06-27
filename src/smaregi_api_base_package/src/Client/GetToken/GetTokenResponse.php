<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Client\GetToken;

use Psr\Http\Message\ResponseInterface;
use Smaregi\SmaregiApiClient\Foundation\Json\Decoder;

class GetTokenResponse
{
    /** @var ResponseInterface */
    private $response;

    /** @var string */
    private $contents;

    /**
     * constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->contents = $this->response->getBody()->getContents();
    }

    /**
     * @throws \JsonException
     * @return GetTokenParams
     */
    public function params(): GetTokenParams
    {
        return GetTokenParams::fromArray(Decoder::decode($this->contents, true));
    }
}
