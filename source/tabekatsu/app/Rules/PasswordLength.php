<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordLength implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strlen($value) >= 6 && strlen($value) <= 16;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '許容されるパスワードの長さは6文字以上、16文字以下です。';
    }
}
