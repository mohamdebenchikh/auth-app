<?php

namespace App\ValidationRules;

class StringRule
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
        return empty($this->value) ?  true: is_string($this->value);
    }

    public function getMessage()
    {
        return "The {$this->field} field must be a string.";
    }
}
