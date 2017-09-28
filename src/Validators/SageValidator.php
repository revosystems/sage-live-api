<?php

namespace RevoSystems\SageLiveApi\Validators;

class SageValidator
{
    protected $fields;
    protected $attributes;

    public function __construct($fields, $attributes)
    {
        $this->fields     = $fields;
        $this->attributes = $attributes;
    }

    public function validate()
    {
        $this->validateRequiredFields();
        return $this->filterInvalidFields();
    }

    public function validateRequiredFields()
    {
        $this->fields->each(function ($field, $key) {
            if ($field["required"] && ! $this->attributes->keys()->contains($key)) {
                throw new \Exception("Required field {$key} is missing");
            }
        });
    }

    public function filterInvalidFields()
    {
        return $this->attributes->filter(function ($attribute, $key) {
            return $this->fields->keys()->contains($key);
        });
    }
}
