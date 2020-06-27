<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken;

use Smaregi\SmaregiApiToken\Models\Collection\SmaregiApiTokenCollection;

interface GetSmaregiApiTokenOutputPort
{
    /**
     * @param SmaregiApiTokenCollection $smaregiApiTokenCollection
     */
    public function output(SmaregiApiTokenCollection $smaregiApiTokenCollection): void;
}
