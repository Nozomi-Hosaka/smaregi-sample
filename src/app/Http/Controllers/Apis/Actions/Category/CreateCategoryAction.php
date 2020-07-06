<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Actions\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Responses\PosCategory\CreateCategoryResponse;
use Illuminate\Http\JsonResponse;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\PosCategory\UseCase\CreatePosCategory\CreatePosCategory;
use Throwable;

class CreateCategoryAction extends Controller
{
    /**
     * @var CreatePosCategory
     */
    private $createPosCategoryUseCase;

    /**
     * CreateCategoryAction constructor.
     *
     * @param CreatePosCategory $createPosCategoryUseCase
     */
    public function __construct(CreatePosCategory $createPosCategoryUseCase)
    {
        $this->createPosCategoryUseCase = $createPosCategoryUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param CreateCategoryRequest $request
     * @throws SmaregiSpecificationException
     * @return JsonResponse
     */
    public function __invoke(CreateCategoryRequest $request)
    {
        try {
            $response = new CreateCategoryResponse();
            $this->createPosCategoryUseCase->process($request, $response);
        } catch (Throwable $e) {
            throw new SmaregiSpecificationException($e->getMessage(), $e->getCode(), $e);
        }
        return response()->json($response->posCategory()->toArray());
    }
}
