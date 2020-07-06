<?php
declare(strict_types=1);

namespace Smaregi\WebhookLog\Models\ReadModel;

interface WebhookLogReadModelInterface
{
    /**
     * @param int $length
     * @return array
     */
    public function findLatest(int $length = 10): array;
}
