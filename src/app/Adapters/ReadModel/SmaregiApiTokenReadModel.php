<?php
declare(strict_types=1);

namespace App\Adapters\ReadModel;

use Smaregi\SmaregiApiToken\Models\Collection\SmaregiApiTokenCollection;
use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\ReadModel\SmaregiApiTokenReadModelInterface;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

class SmaregiApiTokenReadModel implements SmaregiApiTokenReadModelInterface
{
    /**
     * @var \App\Models\SmaregiApiToken
     */
    private $smaregiApiTokenModel;

    /**
     * SmaregiApiTokenReadModel constructor.
     *
     * @param \App\Models\SmaregiApiToken $smaregiApiTokenModel
     */
    public function __construct(\App\Models\SmaregiApiToken $smaregiApiTokenModel)
    {
        $this->smaregiApiTokenModel = $smaregiApiTokenModel;
    }

    /**
     * @return SmaregiApiTokenCollection
     */
    public function findAll(): SmaregiApiTokenCollection
    {
        $smaregiApiTokens = $this->smaregiApiTokenModel->newQuery()->get();
        return SmaregiApiTokenCollection::fromArray($smaregiApiTokens->toArray());
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
        return $this->generateSmaregiApiTokenEntity($smaregiApiToken);
    }

    /**
     * @param \App\Models\SmaregiApiToken $smaregiApiToken
     * @return SmaregiApiToken
     */
    private function generateSmaregiApiTokenEntity(\App\Models\SmaregiApiToken $smaregiApiToken): SmaregiApiToken
    {
        return new SmaregiApiToken(
            $smaregiApiToken->getAttribute('id'),
            $smaregiApiToken->getAttribute('contract_id'),
            $smaregiApiToken->getAttribute('token_type'),
            $smaregiApiToken->getAttribute('access_token')
        );
    }
}
