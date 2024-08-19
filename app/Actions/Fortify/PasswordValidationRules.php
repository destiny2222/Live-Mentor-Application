<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Validation\Rule;

use Laravel\Fortify\Rules\Password;

class MixedCaseRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/[a-z]/', $value) && preg_match('/[A-Z]/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password must contain both lowercase and uppercase letters.';
    }
}

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            (new Password)
                ->length(8)
                ->requireUppercase()
                ->requireSpecialCharacter()
                ->requireNumeric(),
                new MixedCaseRule(),
            'confirmed'
        ];
    }
}

