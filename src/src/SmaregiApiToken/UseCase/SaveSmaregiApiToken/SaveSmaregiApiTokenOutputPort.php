<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken;

use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;

interface SaveSmaregiApiTokenOutputPort
{
    /**
     * @param SmaregiApiToken $smaregiApiToken
     */
    public function output(SmaregiApiToken $smaregiApiToken): void;
}
