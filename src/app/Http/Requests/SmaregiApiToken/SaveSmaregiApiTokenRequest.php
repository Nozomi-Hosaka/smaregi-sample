<?php
declare(strict_types=1);

namespace App\Http\Requests\SmaregiApiToken;

use Illuminate\Foundation\Http\FormRequest;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenInputPort;

class SaveSmaregiApiTokenRequest extends FormRequest implements SaveSmaregiApiTokenInputPort
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
            'contract_id' => ['required', 'string'],
        ];
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->get('contract_id', '') ?? '';
    }
}
