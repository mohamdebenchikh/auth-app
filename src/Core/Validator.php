<?php

namespace App\Core;

class Validator
{
    protected $data;
    protected $errors = [];
    protected $ruleNamespace = 'App\ValidationRules';

    /**
     * Create a new Validator instance.
     *
     * @param array $data The data to validate.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Validate the data against the given rules.
     *
     * @param array $rules The validation rules.
     * @return $this
     */
    public function validate(array $rules)
    {
        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $singleRule) {
                if (strpos($singleRule, ':') !== false) {
                    [$ruleName, $param] = explode(':', $singleRule);
                } else {
                    $ruleName = $singleRule;
                    $param = '';
                }
                $this->applyRule($field, $ruleName, $param);
            }
        }

        return $this;
    }

    /**
     * Check if the validation passes.
     *
     * @return bool
     */
    public function passes()
    {
        return empty($this->errors);
    }

    /**
     * Check if the validation fails.
     *
     * @return bool
     */
    public function fails()
    {
        return !$this->passes();
    }

    /**
     * Get the validation errors.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Apply a rule to a field.
     *
     * @param string $field The field to validate.
     * @param string $ruleName The name of the rule.
     * @param string $param The parameter for the rule.
     * @return void
     */
    protected function applyRule($field, $ruleName, $param)
    {
        $value = $this->data[$field];
        $ruleClassName = $this->ruleNamespace . '\\' . ucfirst($ruleName) . 'Rule';

        if (class_exists($ruleClassName)) {
            $ruleInstance = new $ruleClassName(str_replace('_',' ',$field), $value, $param);
            if (!$ruleInstance->validate()) {
                $this->addError($field, $ruleInstance->getMessage());
            }
        } else {
            throw new \Exception("Rule class '{$ruleClassName}' not found for validation rule '{$ruleName}'.");
        }
    }

    /**
     * Add an error message for a field.
     *
     * @param string $field The field name.
     * @param string $message The error message.
     * @return void
     */
    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }
    /**
     * Add a field to the data array.
     *
     * @param string $field The field name.
     * @param mixed $value The field value.
     * @return $this
     */
    public function addField($field, $value)
    {
        $this->data[$field] = $value;
        return $this;
    }
}
