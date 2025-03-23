<?php

namespace Odboxxx\SensApi\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SensReceiverRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        $ruls['sensor'] = [
            'required',
            'integer',
            Rule::in([1, 2, 3])
        ];

        if ($this->sensor == 1)
            $ruls['T'] = 'required|numeric';
        if ($this->sensor == 2)
            $ruls['P'] = 'required|numeric|min:0'; 
        if ($this->sensor == 3)
            $ruls['v'] = 'required|numeric|min:0'; 
        
        return $ruls;
    }

    protected function passedValidation(): void
    {
        if ($this->sensor == 1) {
            $sensValue = $this->T;
        } elseif ($this->sensor == 2) {
            $sensValue = $this->P;
        } else {
            $sensValue = $this->v;
        }

        $this->replace([
            'sensor' => (int)$this->sensor,
        ]);

        $this->merge([
            'svalue' => (float)$sensValue,
        ]);
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
