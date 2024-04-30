<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotCommonPassword implements Rule
{
    public function passes($attribute, $value)
    {
        // Common passwords list
        $commonPasswords = [
            'password',
            '123456',
            'qwerty123',
            'namess',
            'Namess',
            'LastName',
            'FirstName',
            'Lastname',
            '12345678910',
            'abcdefghijklmn',




            // Add more common passwords here...
        ];

        // Check if the password is common
        return !in_array(strtolower($value), $commonPasswords);
    }

    public function message()
    {
        return 'Please choose a stronger password.';
    }
}
