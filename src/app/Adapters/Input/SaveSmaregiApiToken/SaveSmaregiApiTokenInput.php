<?php
declare(strict_types=1);

namespace App\Adapters\Input\SaveSmaregiApiToken;

use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenInputPort;

class SaveSmaregiApiTokenInput implements SaveSmaregiApiTokenInputPort
{
    /**
     * @var string
     */
    private $contractId;

    /**
     * @param string $contractId
     */
    public function setContractId(string $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->contractId;
    }
}
