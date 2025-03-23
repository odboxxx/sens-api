<?php

namespace Odboxxx\SensApi\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpaRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       
        $ruls['sensors'] = 'required|array|min:1|max:3'; 
        $ruls['sensors.*'] = Rule::in([1,2,3]); 
        $ruls['sdate'] = 'required|integer|min_digits:10|max_digits:10';
        $ruls['edate'] = 'required|integer|min_digits:10|max_digits:10|gte:sdate';
        
        return $ruls;
    }

    protected function passedValidation()
    {
        $this->replace([
            'sensors' => $this->sensors,
            'sdate' => (int)$this->sdate,
            'edate' => (int)$this->edate,
        ]);
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }    

}
