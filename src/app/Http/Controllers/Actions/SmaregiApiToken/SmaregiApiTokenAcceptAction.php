<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\SmaregiApiToken;

use App\Http\Controllers\Controller;
use App\Models\WebhookLogs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Str;

class SmaregiApiTokenAcceptAction extends Controller
{
    /**
     * @var WebhookLogs
     */
    private $webhookLogs;

    /**
     * SmaregiApiTokenAcceptAction constructor.
     *
     * @param WebhookLogs $webhookLogs
     */
    public function __construct(WebhookLogs $webhookLogs)
    {
        $this->webhookLogs = $webhookLogs;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $webhookLogs = $this->webhookLogs->newQuery()
            ->create([
                'id' => Str::uuid(),
                'header' => json_encode($request->headers->all(), JSON_UNESCAPED_SLASHES),
                'body' => json_encode($request->all(), JSON_UNESCAPED_SLASHES),
            ]);

        Log::info($webhookLogs->toJson());
        return response()->json([], 204);
    }
}
