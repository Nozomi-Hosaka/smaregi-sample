<?php
declare(strict_types=1);

namespace App\Adapters\Factory;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\Factory\SmaregiApiTokenFactoryInterface;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;
use Str;

class SmaregiApiTokenFactory implements SmaregiApiTokenFactoryInterface
{
    /**
     * @param ContractId $contractId
     * @param string $tokenType
     * @param string $accessToken
     * @return SmaregiApiToken
     */
    public function newToken(ContractId $contractId, string $tokenType, string $accessToken): SmaregiApiToken
    {
        return new SmaregiApiToken(
            Str::uuid()->toString(),
            $contractId,
            $tokenType,
            $accessToken
        );
    }
}
