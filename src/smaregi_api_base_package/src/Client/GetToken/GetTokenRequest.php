<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Client\GetToken;

use Fig\Http\Message\RequestMethodInterface;
use LogicException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriInterface;

class GetTokenRequest
{
    /** @var string API HTTPメソッド */
    private const METHOD = RequestMethodInterface::METHOD_POST;

    /** @var string 契約ID */
    private const REPLACE = ':contract_id';

    /** @var string APIエンドポイント(Path部) */
    private const PATH = '/app/' . self::REPLACE . '/token';

    /** @var array */
    private $payload = [
        'grant_type' => 'client_credentials',
        'scopes' => [],
    ];

    /**
     * @var string
     */
    private $contractId;

    /**
     * GetTokenRequest constructor.
     *
     * @param string $contractId
     */
    public function __construct(string $contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * @param string $grantType
     * @return self
     */
    public function withGrantType(string $grantType): self
    {
        $new = clone $this;
        $new->payload['grant_type'] = $grantType;

        return $new;
    }

    /**
     * スコープ
     *
     * @param array $scopes
     * @return self
     */
    public function withScope(array $scopes = []): self
    {
        $new = clone $this;

        $new->payload['scopes'] = $scopes;

        return $new;
    }

    /**
     * リクエストを生成します。
     *
     * @param RequestInterface $request
     * @param StreamFactoryInterface $streamFactory
     * @return RequestInterface
     */
    public function toPsrRequest(RequestInterface $request, StreamFactoryInterface $streamFactory): RequestInterface
    {
        $request = $request
            ->withMethod(self::METHOD)
            ->withUri($this->endpointUri($request->getUri()))
            ->withBody($streamFactory->createStream(
                http_build_query([
                    'grant_type' => $this->payload['grant_type'],
                    'scopes' => $this->payload['scopes'],
                ], '', '&')
            ));

        if (!$request->getBody()->isWritable()) {
            throw new LogicException('Non-writable request instance.');
        }

        return $request;
    }

    /**
     * APIエンドポイントのURIを取得します。
     *
     * @param UriInterface $base
     * @return UriInterface
     */
    private function endpointUri(UriInterface $base): UriInterface
    {
        $path = str_replace(self::REPLACE, $this->contractId, self::PATH);
        return $base->withPath($path);
    }
}
