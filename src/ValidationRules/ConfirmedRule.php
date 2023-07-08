<?php

namespace App\ValidationRules;

use App\Core\Request;

class ConfirmedRule
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
        $request = new Request();
        if($request->has("{$this->field}_confirmation")){
            $confirmation = $request->input("{$this->field}_confirmation");
            return $this->value === $confirmation;
        }else if(!empty($this->param)){
            return $this->param === $this->value;
        }
        return false;
    }

    public function getMessage()
    {
        return "The {$this->field} field must match the {$this->field} confirmation field.";
    }
}
