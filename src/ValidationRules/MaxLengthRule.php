<?php

namespace App\ValidationRules;

class MaxLengthRule
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
            $max = intval($this->param);
            return $length <= $max;
        }

        return false;

    }

    public function getMessage()
    {
        return "The {$this->field} must be less than {$this->param} characters.";
    }
}
