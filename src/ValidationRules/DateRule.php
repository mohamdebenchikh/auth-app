<?php
namespace App\ValidationRules;

class DateRule
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

        // Check if the value is a valid date
        $date = date_parse($this->value);
        return $date['error_count'] === 0 && $date['warning_count'] === 0;
    }

    public function getMessage()
    {
        return "The {$this->field} field must be a valid date.";
    }
}
