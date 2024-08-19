<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            'field'=>['required','string'],
            'password'=>['required']
        ];
    }
    public function authenticate()
    {
        $adminUsers = Admin::where('email', $this->field)->orWhere('phone',$this->field)->get();
        foreach ($adminUsers as $adminUser) {
            if (!$adminUser || Hash::check($this->password, $adminUser->password)) {
                // dd($adminUser);
                Auth::guard('admin')->login($adminUser);
                return;
            }
            throw ValidationException::withMessages([
                'field'=>'The data does not match with what we have in our database'
            ]);
        }
        
    }
}
