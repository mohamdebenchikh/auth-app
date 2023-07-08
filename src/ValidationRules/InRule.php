<?php
namespace App\ValidationRules;

class InRule
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

        $values = explode(',', $this->param);

        return in_array($this->value, $values);
    }

    public function getMessage()
    {
        $allowedValues = implode(', ', explode(',', $this->param));
        return "The {$this->field} field must be one of the following values: {$allowedValues}.";
    }
}
