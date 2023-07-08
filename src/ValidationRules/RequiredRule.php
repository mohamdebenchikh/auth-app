<?php

namespace App\ValidationRules;

class RequiredRule
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
        return !empty($this->value);
    }

    public function getMessage()
    {
        return "The {$this->field} is required";
    }
}
