<?php
declare(strict_types=1);

namespace App\Http\Responses\WebhookLog;

use Smaregi\WebhookLog\Query\GetWebhookLog\GetWebhookLogOutputPort;

class GetWebhookLogResponse implements GetWebhookLogOutputPort
{
    /**
     * @var array
     */
    private $logs;

    /**
     * @param array $logs
     */
    public function output(array $logs): void
    {
        $this->logs = $logs;
    }

    /**
     * @return array
     */
    public function logs(): array
    {
        return $this->logs;
    }
}
