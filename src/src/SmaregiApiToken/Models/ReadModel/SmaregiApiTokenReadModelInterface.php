<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\ReadModel;

use Smaregi\SmaregiApiToken\Models\Collection\SmaregiApiTokenCollection;
use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

interface SmaregiApiTokenReadModelInterface
{
    /**
     * @return SmaregiApiTokenCollection
     */
    public function findAll(): SmaregiApiTokenCollection;

    /**
     * @param ContractId $contractId
     * @return SmaregiApiToken|null
     */
    public function findByContractId(ContractId $contractId): ?SmaregiApiToken;
}
