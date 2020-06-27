<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Client;

use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Smaregi\SmaregiApiClient\Client\Exceptions\UnauthorizedException;
use Smaregi\SmaregiApiClient\Client\GetToken\GetTokenRequest;
use Smaregi\SmaregiApiClient\Client\GetToken\GetTokenResponse;
use Smaregi\SmaregiApiClient\Client\Exceptions\BadRequestException;
use Smaregi\SmaregiApiClient\Client\Exceptions\ConflictException;
use Smaregi\SmaregiApiClient\Foundation\Credential;
use Smaregi\SmaregiApiClient\Foundation\PsrFactories;

class Client
{
    /** @var UriInterface API URL */
    private $url;

    /** @var Credential 認証情報 */
    private $credential;

    /** @var ClientInterface */
    private $httpClient;

    /** @var PsrFactories */
    private $psrFactories;

    /**
     * Client constructor.
     *
     * @param UriInterface $url
     * @param Credential $credential
     * @param ClientInterface $client
     * @param PsrFactories $psrFactories
     */
    public function __construct(
        UriInterface $url,
        Credential $credential,
        ClientInterface $client,
        PsrFactories $psrFactories
    ) {
        $this->url = $url;
        $this->credential = $credential;
        $this->httpClient = $client;
        $this->psrFactories = $psrFactories;
    }

    /**
     * クライアントの作成
     *
     * @param GetTokenRequest $request
     * @throws ClientExceptionInterface|\JsonException
     * @return GetTokenResponse
     */
    public function getApiToken(GetTokenRequest $request): GetTokenResponse
    {
        $request = $request->toPsrRequest($this->newRequest(), $this->psrFactories->getStreamFactory());
        $response = $this->sendRequest($request);
        if ($response->getStatusCode() === 400) {
            throw new BadRequestException($request, $response->getBody()->getContents());
        } elseif ($response->getStatusCode() === 401) {
            throw new UnauthorizedException($request, $response->getBody()->getContents());
        } elseif ($response->getStatusCode() === 409) {
            throw new ConflictException($request, $response->getBody()->getContents());
        }
        return new GetTokenResponse($response);
    }

    /**
     * @return RequestInterface
     */
    private function newRequest(): RequestInterface
    {
        return $this->psrFactories
            ->getRequestFactory()
            ->createRequest(RequestMethodInterface::METHOD_GET, $this->url);
    }

    /**
     * リクエスト送信
     *
     * @param RequestInterface $request
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    private function sendRequest(RequestInterface $request): ResponseInterface
    {
        // 認証情報を付加
        $request = $request
            ->withHeader('Authorization', $this->credential->toHeaderAuthorizationBasic())
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded');

        return $this->httpClient->sendRequest($request);
    }
}
