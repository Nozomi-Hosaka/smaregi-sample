<?php
declare(strict_types=1);

namespace Smaregi\WebhookLog\Query\GetWebhookLog;

interface GetWebhookLogOutputPort
{
    /**
     * @param array $logs
     */
    public function output(array $logs): void;
}
