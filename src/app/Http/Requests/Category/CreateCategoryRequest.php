<?php
declare(strict_types=1);

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Smaregi\PosCategory\UseCase\CreatePosCategory\CreatePosCategoryInputPort;

class CreateCategoryRequest extends FormRequest implements CreatePosCategoryInputPort
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:85'],
        ];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->get('name', '') ?? '';
    }
}
