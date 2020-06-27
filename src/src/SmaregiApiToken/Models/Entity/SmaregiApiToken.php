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
    private $token;

    /**
     * SmaregiApiToken constructor.
     *
     * @param string $id
     * @param ContractId $contractId
     * @param string $token
     */
    public function __construct(string $id, ContractId $contractId, string $token)
    {
        $this->id = $id;
        $this->contractId = $contractId;
        $this->token = $token;
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
    public function token(): string
    {
        return (string) $this->token;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (string) $this->id(),
            'contract_id' => (string) $this->contractId(),
            'token' => (string) $this->token(),
        ];
    }
}
