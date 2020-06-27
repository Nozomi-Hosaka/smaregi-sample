<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\Factory;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

interface SmaregiApiTokenFactoryInterface
{
    /**
     * @param ContractId $contractId
     * @param string $tokenType
     * @param string $accessToken
     * @return SmaregiApiToken
     */
    public function newToken(ContractId $contractId, string $tokenType, string $accessToken): SmaregiApiToken;
}
