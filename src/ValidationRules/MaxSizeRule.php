<?php

namespace App\ValidationRules;

class MaxSizeRule
{
    protected $field;
    protected $value;
    protected $maxSize;

    public function __construct($field, $value, $maxSize)
    {
        $this->field = $field;
        $this->value = $value;
        $this->maxSize = $maxSize;
    }

    public function validate()
    {
        if (empty($this->value) || !is_uploaded_file($this->value['tmp_name'])) {
            return true;
        }

        $fileSize = $this->value['size'] / 1024; // Convert maxSize from KB to bytes;
        $maxSizeInBytes = $this->maxSize;

        return $fileSize <= $maxSizeInBytes;
    }

    public function getMessage()
    {
        return "The {$this->field} file size must be within {$this->maxSize} KB.";
    }
}
