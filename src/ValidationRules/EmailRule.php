<?php

namespace App\ValidationRules;

class EmailRule
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
        return empty($this->value) ? true : filter_var($this->value,FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getMessage()
    {
        return "The {$this->field} must be a valid email address.";
    }
}
