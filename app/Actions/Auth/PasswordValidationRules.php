<?php

namespace App\Actions\Auth;

use App\Actions\Auth\PasswordRules;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new PasswordRules, 'confirmed'];
    }
}
