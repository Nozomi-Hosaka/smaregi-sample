<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken;

interface GetSmaregiApiTokenInputPort
{
    /**
     * @return string
     */
    public function contractId(): string;
}
