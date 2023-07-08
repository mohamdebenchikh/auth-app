<?php

namespace App\ValidationRules;

class MinLengthRule
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
        if(empty($this->value)){
            return true;
        }

        if(is_string($this->value)){
            $length = strlen($this->value);
            $min = intval($this->param);
            return $length >= $min;
        }

        return false;

    }

    public function getMessage()
    {
        return "The {$this->field} must be at least {$this->param} characters.";
    }
}
