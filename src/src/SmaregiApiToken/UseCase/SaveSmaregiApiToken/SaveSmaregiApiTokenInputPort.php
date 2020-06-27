<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken;

interface SaveSmaregiApiTokenInputPort
{
    /**
     * @return string
     */
    public function contractId(): string;
}
