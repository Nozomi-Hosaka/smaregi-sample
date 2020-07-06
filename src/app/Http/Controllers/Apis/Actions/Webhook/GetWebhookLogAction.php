<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Actions\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\GetWebhookLogRequest;
use App\Http\Responses\WebhookLog\GetWebhookLogResponse;
use Illuminate\Http\JsonResponse;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\WebhookLog\Query\GetWebhookLog\GetWebhookLogInterface;
use Throwable;

class GetWebhookLogAction extends Controller
{
    /**
     * @var GetWebhookLogInterface
     */
    private $getWebhookLogUseCase;

    /**
     * GetWebhookLogAction constructor.
     *
     * @param GetWebhookLogInterface $getWebhookLogUseCase
     */
    public function __construct(GetWebhookLogInterface $getWebhookLogUseCase)
    {
        $this->getWebhookLogUseCase = $getWebhookLogUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetWebhookLogRequest $request
     * @throws SmaregiSpecificationException
     * @return JsonResponse
     */
    public function __invoke(GetWebhookLogRequest $request)
    {
        try {
            $response = new GetWebhookLogResponse();
            $this->getWebhookLogUseCase->process($request, $response);
        } catch (Throwable $e) {
            throw new SmaregiSpecificationException($e->getMessage(), $e->getCode(), $e);
        }
        return response()->json($response->logs());
    }
}
