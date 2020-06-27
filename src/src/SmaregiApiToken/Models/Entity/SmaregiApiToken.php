<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\Entity;

use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

class SmaregiApiToken
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var ContractId
     */
    private $contractId;

    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * SmaregiApiToken constructor.
     *
     * @param string $id
     * @param ContractId $contractId
     * @param string $tokenType
     * @param string $accessToken
     */
    public function __construct(string $id, ContractId $contractId, string $tokenType, string $accessToken)
    {
        $this->id = $id;
        $this->contractId = $contractId;
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return (string) $this->id;
    }

    /**
     * @return ContractId
     */
    public function contractId(): ContractId
    {
        return $this->contractId;
    }

    /**
     * @return string
     */
    public function tokenType(): string
    {
        return (string) $this->tokenType;
    }

    /**
     * @return string
     */
    public function accessToken(): string
    {
        return (string) $this->accessToken;
    }

    /**
     * @param string $tokenType
     */
    public function setTokenType(string $tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (string) $this->id(),
            'contract_id' => (string) $this->contractId(),
            'token_type' => (string) $this->tokenType(),
            'access_token' => (string) $this->accessToken(),
        ];
    }
}
