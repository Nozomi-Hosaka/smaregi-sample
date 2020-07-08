<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\SmaregiApiToken;

use App\Adapters\Input\SaveSmaregiApiToken\SaveSmaregiApiTokenInput;
use App\Adapters\Input\SaveSmaregiApiToken\SaveSmaregiApiTokenOutput;
use App\Http\Controllers\Controller;
use App\Models\WebhookLogs;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenInterface;
use Str;
use Throwable;

class SmaregiApiTokenAcceptAction extends Controller
{
    /**
     * @var WebhookLogs
     */
    private $webhookLogs;
    /**
     * @var SaveSmaregiApiTokenInterface
     */
    private $saveSmaregiApiTokenUseCase;

    /**
     * SmaregiApiTokenAcceptAction constructor.
     *
     * @param WebhookLogs $webhookLogs
     * @param SaveSmaregiApiTokenInterface $saveSmaregiApiTokenUseCase
     */
    public function __construct(
        WebhookLogs $webhookLogs,
        SaveSmaregiApiTokenInterface $saveSmaregiApiTokenUseCase
    ) {
        $this->webhookLogs = $webhookLogs;
        $this->saveSmaregiApiTokenUseCase = $saveSmaregiApiTokenUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @throws SmaregiSpecificationException
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        DB::beginTransaction();
        try {
            $webhookLogs = $this->webhookLogs->newQuery()
                ->create([
                    'id' => Str::uuid(),
                    'header' => json_encode($request->headers->all(), JSON_UNESCAPED_SLASHES),
                    'body' => json_encode($request->all(), JSON_UNESCAPED_SLASHES),
                ]);

            Log::info($webhookLogs->toJson());

            $this->registerContractId($request);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new SmaregiSpecificationException($e->getMessage(), $e->getCode(), $e);
        }

        return response()->json([], 204);
    }

    /**
     * @param Request $request
     */
    private function registerContractId(Request $request): void
    {
        $contractId = $request->get('contractId', '') ?? '';
        $input = new SaveSmaregiApiTokenInput();
        $input->setContractId($contractId);
        $output = new SaveSmaregiApiTokenOutput();
        $this->saveSmaregiApiTokenUseCase->process($input, $output);
        logger($output->smaregiApiToken()->toArray());
    }
}
