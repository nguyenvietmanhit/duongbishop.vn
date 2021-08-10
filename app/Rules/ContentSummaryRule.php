<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContentSummaryRule implements Rule
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
      if (!$value) {
        return false;
      }
      foreach ($value AS $content_value) {
        if (!$content_value) {
          return false;
        }
      }
      return TRUE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cần nhập dữ liệu cho tất cả các trang';
    }
}
