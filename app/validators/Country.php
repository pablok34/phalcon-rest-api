<?php

namespace PhoneBookAPI\Validators;

use Phalcon\Validation\ValidatorInterface;

class Country extends ExternalValidatorBase implements ValidatorInterface
{
    public function validate(\Phalcon\Validation $validation, $attribute)
    {
        return $this->externallValidate($validation, $attribute, 'https://api.hostaway.com/countries');
    }
}
