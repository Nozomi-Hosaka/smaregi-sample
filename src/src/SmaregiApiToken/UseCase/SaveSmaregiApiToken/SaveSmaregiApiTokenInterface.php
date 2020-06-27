<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken;

interface SaveSmaregiApiTokenInterface
{
    /**
     * @param SaveSmaregiApiTokenInputPort $inputPort
     * @param SaveSmaregiApiTokenOutputPort $outputPort
     */
    public function process(
        SaveSmaregiApiTokenInputPort $inputPort,
        SaveSmaregiApiTokenOutputPort $outputPort
    ): void;
}
