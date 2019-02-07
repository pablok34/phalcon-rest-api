<?php

namespace PhoneBookAPI\Validators;

use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

abstract class ExternalValidatorBase extends Validator
{
    public function externallValidate(\Phalcon\Validation $validation, $attribute, $url)
    {
        if (!empty($validation->getValue($attribute))) {
            $client = new Client();

            try {
                //$request = $client->request('GET', 'https://httpstat.us/500');
                $request = $client->request('GET', $url);
                $requestBody = json_decode($request->getBody(), true);
            } catch (BadResponseException $exception) {
                $exceptionInfo = [
                    'Request' => Psr7\str($exception->getRequest()),
                    'Response' => Psr7\str($exception->getResponse())
                ];

                $di = \Phalcon\DI::getDefault();
                $di->getShared('logger')->critical('Error connecting to external API: ' . print_r($exceptionInfo, true));

                $message = 'We are having problems to validate 
                    ' . $attribute . ' at this moment. Please remove this field or try later.';

                $validation->appendMessage(new \Phalcon\Validation\Message($message, $attribute, 'Date'));
                return false;
            }

            if (!array_key_exists($validation->getValue($attribute), $requestBody['result'])) {
                $message = $this->getOption('message');
                $validation->appendMessage(new \Phalcon\Validation\Message($message, $attribute, 'Date'));
                return false;
            }
        }
        return true;
    }
}
