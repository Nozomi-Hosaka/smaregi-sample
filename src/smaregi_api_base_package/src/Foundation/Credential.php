<?php

declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Foundation;

/**
 * Credential - 認証情報
 */
final class Credential
{
    /** @var string */
    private $clientId;

    /** @var string */
    private $secret;

    /**
     * constructor.
     * @param string $clientId
     * @param string $secret
     */
    public function __construct(string $clientId, string $secret)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
    }

    /**
     * @return string クライアントID
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Authorizationヘッダー Basicトークン
     * @return string
     */
    public function toHeaderAuthorizationBasic(): string
    {
        return 'Basic ' . base64_encode("{$this->clientId}:{$this->secret}");
    }

    public function __debugInfo()
    {
        return [
            'clientId' => $this->clientId,
            // シークレットをデバッグ情報に出力しない
            'secret' => '(hidden)',
        ];
    }
}
