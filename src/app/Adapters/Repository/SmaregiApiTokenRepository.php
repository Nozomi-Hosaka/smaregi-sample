<?php
declare(strict_types=1);

namespace App\Adapters\Repository;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\Repository\SmaregiApiTokenRepositoryInterface;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

class SmaregiApiTokenRepository implements SmaregiApiTokenRepositoryInterface
{
    /**
     * @var \App\Models\SmaregiApiToken
     */
    private $smaregiApiTokenModel;

    /**
     * SmaregiApiTokenRepository constructor.
     *
     * @param \App\Models\SmaregiApiToken $smaregiApiTokenModel
     */
    public function __construct(\App\Models\SmaregiApiToken $smaregiApiTokenModel)
    {
        $this->smaregiApiTokenModel = $smaregiApiTokenModel;
    }

    /**
     * @param ContractId $contractId
     * @return SmaregiApiToken|null
     */
    public function findByContractId(ContractId $contractId): ?SmaregiApiToken
    {
        /** @var \App\Models\SmaregiApiToken $smaregiApiToken */
        $smaregiApiToken = $this->smaregiApiTokenModel->newQuery()
            ->where('contract_id', (string) $contractId)
            ->first();
        if ($smaregiApiToken === null) {
            return null;
        }
        return new SmaregiApiToken(
            $smaregiApiToken->getAttribute('id'),
            new ContractId($smaregiApiToken->getAttribute('contract_id')),
            $smaregiApiToken->getAttribute('token_type'),
            $smaregiApiToken->getAttribute('access_token'),
        );
    }

    /**
     * @param SmaregiApiToken $smaregiApiToken
     * @return SmaregiApiToken
     */
    public function save(SmaregiApiToken $smaregiApiToken): SmaregiApiToken
    {
        $this->smaregiApiTokenModel->newQuery()
            ->firstOrNew([
                'id' => $smaregiApiToken->id(),
            ])->fill([
                'contract_id' => $smaregiApiToken->contractId(),
                'token_type' => $smaregiApiToken->tokenType(),
                'access_token' => $smaregiApiToken->accessToken(),
            ])->save();
        return $smaregiApiToken;
    }
}
