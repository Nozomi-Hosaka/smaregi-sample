<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken;

interface GetSmaregiApiTokenInterface
{
    /**
     * @param GetSmaregiApiTokenInputPort $inputPort
     * @param GetSmaregiApiTokenOutputPort $outputPort
     */
    public function process(GetSmaregiApiTokenInputPort $inputPort, GetSmaregiApiTokenOutputPort $outputPort): void;
}
