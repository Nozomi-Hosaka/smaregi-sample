<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\Repository;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

interface SmaregiApiTokenRepositoryInterface
{
    /**
     * @param ContractId $contractId
     * @return SmaregiApiToken|null
     */
    public function findByContractId(ContractId $contractId): ?SmaregiApiToken;

    /**
     * @param SmaregiApiToken $smaregiApiToken
     * @return SmaregiApiToken
     */
    public function save(SmaregiApiToken $smaregiApiToken): SmaregiApiToken;
}
