<?php
declare(strict_types=1);

namespace App\Adapters\Input\SaveSmaregiApiToken;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenOutputPort;

class SaveSmaregiApiTokenOutput implements SaveSmaregiApiTokenOutputPort
{
    /**
     * @var SmaregiApiToken
     */
    private $smaregiApiToken;

    /**
     * @param SmaregiApiToken $smaregiApiToken
     */
    public function output(SmaregiApiToken $smaregiApiToken): void
    {
        $this->smaregiApiToken = $smaregiApiToken;
    }

    /**
     * @return SmaregiApiToken
     */
    public function smaregiApiToken(): SmaregiApiToken
    {
        return $this->smaregiApiToken;
    }
}
