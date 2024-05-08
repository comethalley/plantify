<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotSameAsName implements Rule
{
    protected $firstName;
    protected $lastName;

    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function passes($attribute, $value)
    {
        // I-check kung ang password ay hindi katulad ng unang pangalan o huling pangalan ng user
        return strtolower($value) !== strtolower($this->firstName) && strtolower($value) !== strtolower($this->lastName);
    }

    public function message()
    {
        return 'The password cannot be the same as the first name or last name.';
    }
}
