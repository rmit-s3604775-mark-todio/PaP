<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Less than or equal to if the specified field is not null
 * 
 */
class ltenn implements Rule
{

    /**
     * The field name 
     * 
     * @var $fieldName
     */
    public $fieldName;

    /**
     * The field to compare against
     * 
     * @var $fieldValue
     */
    public $fieldValue;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($fieldName, $fieldValue)
    {
        $this->fieldValue = $fieldValue;
        $this->fieldName = $fieldName;
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
        if($this->fieldValue != null) {
            return $value <= $this->fieldValue ? true : false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute is not less than or equal ".$this->fieldName.".";
    }
}
