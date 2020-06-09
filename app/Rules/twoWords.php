<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use function GuzzleHttp\Psr7\str;

class twoWords implements Rule
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
        return count(explode(' ', $value)) === 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please provide both, name & surname.';
    }
}
