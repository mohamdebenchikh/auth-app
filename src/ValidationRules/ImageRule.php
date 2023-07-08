<?php

namespace App\ValidationRules;

class ImageRule
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
        if (empty($this->value) || !is_uploaded_file($this->value['tmp_name'])) {
            return true;
        }

        $allowedExtensions = explode(',', $this->param);
        $extension = pathinfo($this->value['name'], PATHINFO_EXTENSION);

        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }

        $imageInfo = getimagesize($this->value['tmp_name']);
        $isImage = $imageInfo !== false;

        return $isImage;
    }

    public function getMessage()
    {
        $allowedExtensions = implode(', ', explode(',', $this->param));
        return "The {$this->field} field must be an image with the following extensions: {$allowedExtensions}.";
    }
}
