<?php

namespace App\ValidationRules;

use App\Core\Database;

class UniqueRule
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
        if (empty($this->value)) return true;

        $params = explode(',', $this->param);
        $table = $params[0];
        $db = new Database();
        $db->table($table)->select([$this->field]);

        if (isset($params[1]) && isset($params[2])) {
            $db->where($params[1], '!=', $params[2]);
        }

        $result = $db->where($this->field, '=', $this->value)->first();
        return empty($result);
    }

    public function getMessage()
    {
        return "The {$this->field} has already taken.";
    }
}
