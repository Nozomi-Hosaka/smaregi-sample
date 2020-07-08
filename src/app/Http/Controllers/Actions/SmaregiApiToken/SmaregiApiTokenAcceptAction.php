<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\SmaregiApiToken;

use App\Http\Controllers\Controller;
use App\Models\WebhookLogs;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\SmaregiApiToken\Models\Factory\SmaregiApiTokenFactoryInterface;
use Smaregi\SmaregiApiToken\Models\Repository\SmaregiApiTokenRepositoryInterface;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;
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
     * @var SmaregiApiTokenRepositoryInterface
     */
    private $smaregiApiTokenRepository;

    /**
     * @var SmaregiApiTokenFactoryInterface
     */
    private $smaregiApiTokenFactory;

    /**
     * SmaregiApiTokenAcceptAction constructor.
     *
     * @param WebhookLogs $webhookLogs
     * @param SaveSmaregiApiTokenInterface $saveSmaregiApiTokenUseCase
     * @param SmaregiApiTokenRepositoryInterface $smaregiApiTokenRepository
     * @param SmaregiApiTokenFactoryInterface $smaregiApiTokenFactory
     */
    public function __construct(
        WebhookLogs $webhookLogs,
        SaveSmaregiApiTokenInterface $saveSmaregiApiTokenUseCase,
        SmaregiApiTokenRepositoryInterface $smaregiApiTokenRepository,
        SmaregiApiTokenFactoryInterface $smaregiApiTokenFactory
    ) {
        $this->webhookLogs = $webhookLogs;
        $this->saveSmaregiApiTokenUseCase = $saveSmaregiApiTokenUseCase;
        $this->smaregiApiTokenRepository = $smaregiApiTokenRepository;
        $this->smaregiApiTokenFactory = $smaregiApiTokenFactory;
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
        try {
            $webhookLogs = $this->webhookLogs->newQuery()
                ->create([
                    'id' => Str::uuid(),
                    'header' => json_encode($request->headers->all(), JSON_UNESCAPED_SLASHES),
                    'body' => json_encode($request->all(), JSON_UNESCAPED_SLASHES),
                ]);

            Log::info($webhookLogs->toJson());
        } catch (Throwable $e) {
            throw new SmaregiSpecificationException($e->getMessage(), $e->getCode(), $e);
        }

        DB::beginTransaction();
        try {
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
        $contractId = new ContractId($request->get('contractId', '') ?? '');
        $smaregiApiToken = $this->smaregiApiTokenRepository->findByContractId($contractId);
        if ($smaregiApiToken === null) {
            $smaregiApiToken = $this->smaregiApiTokenFactory->newToken($contractId, '', '');
            $smaregiApiToken = $this->smaregiApiTokenRepository->save($smaregiApiToken);
            logger($smaregiApiToken->toArray());
        }
    }
}
