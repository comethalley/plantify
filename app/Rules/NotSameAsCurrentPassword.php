<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class NotSameAsCurrentPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return !Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'The new password cannot be the same as the current password.';
    }
}
