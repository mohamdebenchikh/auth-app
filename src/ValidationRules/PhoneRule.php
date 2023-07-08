<?php


namespace App\ValidationRules;

class PhoneRule
{
    protected $field;
    protected $value;
    protected $param;

    public function __construct($field, $value, $param)
    {
        $this->field = $field;
        $this->value = $value;
        $this->param = $param;
    }

    public function validate()
    {
        if (empty($this->value)) {
            return true;
        }

        // Add your phone validation logic here
        // You can use regular expressions or any other validation method

        // Example: Validate if the value is a valid phone number with 10 digits
        $pattern = '/^\+\d{10,20}$/';
        return preg_match($pattern, $this->value) === 1;
    }

    public function getMessage()
    {
        return "The {$this->field} field must be a valid phone number.";
    }
}
