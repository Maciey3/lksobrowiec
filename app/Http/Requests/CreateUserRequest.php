<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use App\Alert\Alert;

class CreateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:users', 'string', 'max:32'],
            'password' => ['required', 'confirmed', 'min:6', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ];
    }

    public function messages(){
        return [
            'name.unique' => 'Użytkownik o takiej nazwie już istnieje',
            'password.confirmed' => 'Podane hasła muszą być takie same',
            'password.min' => 'Hasło musi zawierać co najmniej :min znaków',
            'password.regex' => 'Hasło musi zawierać co najmniej 1 dużą literę, 1 cyfrę i 1 znak specjalny',
        ];
    }

    protected function failedValidation(Validator $validator){
        // dd($validator);
        // dd($validator->errors()->first());
        $alert = new Alert('fail', $validator->errors()->first());
        $alert->use();

        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }
}
