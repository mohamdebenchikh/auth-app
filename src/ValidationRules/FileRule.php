<?php
namespace App\ValidationRules;

class FileRule
{
    protected $field;
    protected $value;
    protected $param;

    public function __construct($field, $value,$param)
    {
        $this->field = $field;
        $this->value = $value;
        $this->param = $param;
    }

    public function validate()
    {
        if (empty($this->value) || !is_uploaded_file($this->value['tmp_name'])) {
            return false;
        }

        return true;
    }

    public function getMessage()
    {
        return "The {$this->field} field must be a file.";
    }
}
