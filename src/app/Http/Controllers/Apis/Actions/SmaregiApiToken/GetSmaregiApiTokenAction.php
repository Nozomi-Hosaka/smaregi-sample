<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Actions\SmaregiApiToken;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmaregiApiToken\GetSmaregiApiTokenRequest;
use App\Http\Responses\SmaregiApiToken\GetSmaregiApiTokenResponse;
use Illuminate\Http\JsonResponse;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiTokenInterface;
use Throwable;

class GetSmaregiApiTokenAction extends Controller
{
    /**
     * @var GetSmaregiApiTokenInterface
     */
    private $useCase;

    /**
     * GetSmaregiApiTokenAction constructor.
     *
     * @param GetSmaregiApiTokenInterface $useCase
     */
    public function __construct(GetSmaregiApiTokenInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetSmaregiApiTokenRequest $request
     * @throws SmaregiSpecificationException
     * @return JsonResponse
     */
    public function __invoke(GetSmaregiApiTokenRequest $request)
    {
        $response = new GetSmaregiApiTokenResponse();
        try {
            $this->useCase->process($request, $response);
        } catch (Throwable $e) {
            logger($e);
            throw new SmaregiSpecificationException($e->getMessage(), $e->getCode(), $e);
        }
        return response()->json($response->smaregiApiTokenCollection()->toArray());
    }
}
