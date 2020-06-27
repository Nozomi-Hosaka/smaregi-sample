<?php
declare(strict_types=1);

namespace App\Http\Requests\SmaregiApiToken;

use Illuminate\Foundation\Http\FormRequest;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiTokenInputPort;

class GetSmaregiApiTokenRequest extends FormRequest implements GetSmaregiApiTokenInputPort
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
            //
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
