<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params) : bool
    {
        // Checking if the field isn't empty
        return !empty($data[$field]);
    }

    public function getMessage(array $data, string $field, array $params) : string
    {
        // Return message if field is empty
        return "This field is required.";
    }
}