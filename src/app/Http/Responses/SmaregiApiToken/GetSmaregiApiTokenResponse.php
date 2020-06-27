<?php
declare(strict_types=1);

namespace App\Http\Responses\SmaregiApiToken;

use Smaregi\SmaregiApiToken\Models\Collection\SmaregiApiTokenCollection;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiTokenOutputPort;

class GetSmaregiApiTokenResponse implements GetSmaregiApiTokenOutputPort
{
    /**
     * @var SmaregiApiTokenCollection
     */
    private $smaregiApiTokenCollection;

    /**
     * @param SmaregiApiTokenCollection $smaregiApiTokenCollection
     */
    public function output(SmaregiApiTokenCollection $smaregiApiTokenCollection): void
    {
        $this->smaregiApiTokenCollection = $smaregiApiTokenCollection;
    }

    /**
     * @return SmaregiApiTokenCollection
     */
    public function smaregiApiTokenCollection(): SmaregiApiTokenCollection
    {
        return $this->smaregiApiTokenCollection;
    }
}
