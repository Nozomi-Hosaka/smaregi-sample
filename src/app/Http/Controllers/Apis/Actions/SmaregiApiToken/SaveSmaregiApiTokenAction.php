<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Actions\SmaregiApiToken;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmaregiApiToken\SaveSmaregiApiTokenRequest;
use App\Http\Responses\SmaregiApiToken\SaveSmaregiApiTokenResponse;
use DB;
use Illuminate\Http\JsonResponse;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenInterface;
use Throwable;

class SaveSmaregiApiTokenAction extends Controller
{
    /**
     * @var SaveSmaregiApiTokenInterface
     */
    private $useCase;

    /**
     * SaveSmaregiApiTokenAction constructor.
     *
     * @param SaveSmaregiApiTokenInterface $useCase
     */
    public function __construct(SaveSmaregiApiTokenInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param SaveSmaregiApiTokenRequest $request
     *@throws SmaregiSpecificationException
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(SaveSmaregiApiTokenRequest $request)
    {
        $response = new SaveSmaregiApiTokenResponse();
        DB::beginTransaction();
        try {
            $this->useCase->process($request, $response);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logger($e);
            throw new SmaregiSpecificationException($e->getMessage(), (int)$e->getCode(), $e);
        }
        return response()->json($response->smaregiApiToken()->toArray());
    }
}
