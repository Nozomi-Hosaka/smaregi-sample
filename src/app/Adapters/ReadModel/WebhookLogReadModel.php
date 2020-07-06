<?php
declare(strict_types=1);

namespace App\Adapters\ReadModel;

use App\Models\WebhookLogs;
use Smaregi\WebhookLog\Models\ReadModel\WebhookLogReadModelInterface;

class WebhookLogReadModel implements WebhookLogReadModelInterface
{
    /**
     * @var WebhookLogs
     */
    private $webhookLogs;

    /**
     * WebhookLogReadModel constructor.
     *
     * @param WebhookLogs $webhookLogs
     */
    public function __construct(WebhookLogs $webhookLogs)
    {
        $this->webhookLogs = $webhookLogs;
    }

    /**
     * @param int $length
     * @return array
     */
    public function findLatest(int $length = 10): array
    {
        $array = [];
        $logs = $this->webhookLogs->newQuery()
            ->latest('created_at')
            ->limit($length)
            ->get();

        /** @var WebhookLogs $log */
        foreach ($logs as $log) {
            $array[] = [
                'id' => (string)$log->getAttribute('id'),
                'header' => json_decode((string)$log->getAttribute('header')),
                'body' => json_decode((string)$log->getAttribute('body')),
                'created_at' => (string)$log->getAttribute('created_at'),
                'updated_at' => (string)$log->getAttribute('updated_at'),
            ];
        }
        return $array;
    }
}
