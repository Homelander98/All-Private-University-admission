<?php

namespace Green\Library;

class FormValidator
{
    protected array $data = [];
    protected array $errors = [];
    protected array $rules = [];

    protected bool $continueOnError = false;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Set validation rules
    public function rules(array $rules)
    {
        $this->rules = $rules;
    }

    // Run validation against the rules
    public function validate()
    {
        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $this->applyRule($field, $rule);

                if (!$this->continueOnError && isset($this->errors[$field])) {
                    break;
                }

            }
        }
        return empty($this->errors);
    }

    // Apply a single rule to a field
    protected function applyRule($field, $rule)
    {
        // Get value from the data array
        $value = isset($this->data[$field]) ? $this->data[$field] : '';

        // Check if the rule is a closure
        if ($rule instanceof \Closure) {
            // Bind the closure to this instance
            $rule = $rule->bindTo($this);
            // Call the closure with the field name and value
            $rule($field, $value);
            return;
        }


        // Parse rule and extract rule name and arguments
        $ruleName = $rule;
        $ruleArgs = [];

        if (strpos($rule, ':') !== false) {
            list($ruleName, $argString) = explode(':', $rule, 2);
            $ruleArgs = explode(',', $argString); // Handle multiple arguments
        }


        // Only call if the rule method exists
        $methodName = 'validate' . ucfirst($ruleName);
        if (method_exists($this, $methodName)) {
            $this->$methodName($field, $value, ...$ruleArgs);
        } else {
            throw new \InvalidArgumentException("Validation rule '$ruleName' is not defined.");
        }
    }

    // Get all validation errors
    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorsText()
    {
        $allErrors = [];
        foreach ($this->errors as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                $allErrors[] = $error;
            }
        }
        return implode('<br>', $allErrors);
    }

    // Check if there are any errors
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    // Rule: Required
    protected function validateRequired($field, $value)
    {
        if (strlen(trim($value)) === 0) {
            $this->addError($field, ucfirst($field) . ' is required.');
        }
    }


    protected function validateMinlength($field, $value, $min)
    {
        $min = (int) $min;

        if (strlen($value) < $min) {
            $this->addError($field, ucfirst($field) . " must be at least {$min} characters.");
        }
    }


    // Rule: Max Length
    protected function validateMaxlength($field, $value, $max)
    {
        $max = (int) $max;

        if (strlen($value) > $max) {
            $this->addError($field, ucfirst($field) .  " can't exceed $max characters.");
        }
    }

    // Rule: Email
    protected function validateEmail($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, ucfirst($field) .  " must be a valid email.");
        }
    }

    protected function validateEither($field, $value, ...$args)
    {
        if (!in_array($value, $args)) {
            $this->addError($field, ucfirst($field) .  " must be one of the specified values.");
        }
    }

    // Rule: Either
    protected function validateBetween($field, $value, $min, $max)
    {
        if ($value < $min || $value > $max) {
            $this->addError($field, "Value must be between $min and $max.");
        }
    }

    public function getValidatedData()
    {
        $validatedData = [];
        foreach ($this->rules as $field => $fieldRules) {
            if (isset($this->data[$field])) {
                $validatedData[$field] = $this->data[$field];
            }
        }
        return $validatedData;
    }

    public function getValidatedFiles()
    {
        $validatedData = [];

        foreach (array_keys($this->rules) as $key) {
            if (isset($_FILES[$key])) {
                $validatedData[$key] = $_FILES[$key];
            }

        }


        return $validatedData;

    }

    // Add an error message for a specific field
    public function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function saveOldData(array $except = [])
    {
        $data = $this->getValidatedData();

        foreach ($except as $key) {
            unset($data[$key]);
        }

        $_SESSION['_old'] = $data;
    }


    protected function validateRegex($field, $value, $pattern)
    {
        if (!preg_match($pattern, $value)) {
            $this->addError($field, ucfirst($field) . " does not match the required pattern.");
        }
    }

    protected function validateFile($field, $value)
    {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            $this->addError($field, ucfirst($field) . " must be a valid uploaded file.");
        }
    }

    protected function validateFilesize($field, $value, $maxSize)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $maxSizeBytes = (int)$maxSize * 1024 * 1024; // Convert MB to bytes
            if ($_FILES[$field]['size'] > $maxSizeBytes) {
                $this->addError($field, ucfirst($field) . " exceeds the maximum file size of {$maxSize} MB.");
            }
        }
    }

    // Rule: Mimetype
    protected function validateMimetype($field, $value, ...$allowedMimes)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $fileMime = mime_content_type($_FILES[$field]['tmp_name']);
            if (!in_array($fileMime, $allowedMimes)) {
                $this->addError($field, ucfirst($field) . " must be one of the allowed MIME types: " . implode(', ', $allowedMimes) . ".");
            }
        }
    }



    protected function validateExtensions($field, $value, ...$allowedExtensions)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($fileExtension), array_map('strtolower', $allowedExtensions))) {
                $this->addError($field, ucfirst($field) . " must have one of the allowed extensions: " . implode(', ', $allowedExtensions) . ".");
            }
        }
    }
}
