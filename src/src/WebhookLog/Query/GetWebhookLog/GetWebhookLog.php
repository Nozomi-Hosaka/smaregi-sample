<?php
declare(strict_types=1);

namespace Smaregi\WebhookLog\Query\GetWebhookLog;

use Smaregi\WebhookLog\Models\ReadModel\WebhookLogReadModelInterface;

class GetWebhookLog implements GetWebhookLogInterface
{
    /**
     * @var WebhookLogReadModelInterface
     */
    private $webhookLogRepository;

    /**
     * GetWebhookLog constructor.
     *
     * @param WebhookLogReadModelInterface $webhookLogRepository
     */
    public function __construct(WebhookLogReadModelInterface $webhookLogRepository)
    {
        $this->webhookLogRepository = $webhookLogRepository;
    }

    /**
     * @param GetWebhookLogInputPort $inputPort
     * @param GetWebhookLogOutputPort $outputPort
     */
    public function process(GetWebhookLogInputPort $inputPort, GetWebhookLogOutputPort $outputPort): void
    {
        $logs = $this->webhookLogRepository->findLatest();
        $outputPort->output($logs);
    }
}
