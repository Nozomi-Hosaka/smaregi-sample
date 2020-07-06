<?php
declare(strict_types=1);

namespace Smaregi\WebhookLog\Query\GetWebhookLog;

interface GetWebhookLogInterface
{
    /**
     * @param GetWebhookLogInputPort $inputPort
     * @param GetWebhookLogOutputPort $outputPort
     */
    public function process(GetWebhookLogInputPort $inputPort, GetWebhookLogOutputPort $outputPort): void;
}
