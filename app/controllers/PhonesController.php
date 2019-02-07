<?php

namespace PhoneBookAPI\Controllers;

use PhoneBookAPI\Models\PhoneBooks;

class PhonesController extends ControllerBase
{
    public function findOneAction()
    {
        $id = $this->dispatcher->getParam('id');
        $id = $this->filter->sanitize($id, 'int');

        $phone = PhoneBooks::findFirst($id);
        if ($phone instanceof PhoneBooks) {
            $this->_response['statusCode'] = 200;
            $this->_response['status'] = 'success';
            $this->_response['results'] = [$phone];
        } else {
            $this->_response['statusCode'] = 404;
            $this->_response['status'] = 'Not found';
        }
    }

    public function findAction()
    {
        $findSettings = $this->getPaginationParams();
        $filtersConditions = $this->getFilltersConditionsForModel(new PhoneBooks());

        $phones = PhoneBooks::find(
            array_merge($filtersConditions, $findSettings)
        );
        $total = PhoneBooks::count($filtersConditions);


        $this->_response['statusCode'] = 200;
        $this->_response['status'] = 'success';
        $this->_response['results'] = $phones;
        $this->_response['metadata'] = ['result_set' => $findSettings];
    }

    public function createAction()
    {
        $phoneFields = $this->getFieldsFromRequestForModel(new PhoneBooks());
        $phone = new PhoneBooks($phoneFields);

        if ($phone->save() === false) {
            $messages = $phone->getMessages();
            foreach ($messages as $message) {
                $this->_response['messages'][] = $message->__toString();
            }

            $this->_response['statusCode'] = 409;
            $this->_response['status'] = 'error';
        } else {
            $phone = PhoneBooks::find($phone->getId()); //FIXME: the object date properties are null after save
            $this->_response['statusCode'] = 201;
            $this->_response['status'] = 'Created';
            $this->_response['results'] = $phone;
        }
    }

    public function updateAction()
    {
        $id = $this->dispatcher->getParam('id');
        $id = $this->filter->sanitize($id, 'int');
        $phoneFields = $this->getFieldsFromRequestForModel(new PhoneBooks());

        $phone = PhoneBooks::findFirst($id);

        if ($phone instanceof PhoneBooks && $phone->update($phoneFields) === true) {
            $this->_response['statusCode'] = 200;
            $this->_response['status'] = 'OK';
            $this->_response['results'] = $phone;
        } else {
            $messages = $phone->getMessages();
            foreach ($messages as $message) {
                $this->_response['messages'][] = $message->__toString();
            }

            $this->_response['statusCode'] = 409;
            $this->_response['status'] = 'error';
        }
    }

    public function deleteAction()
    {
        $id = $this->dispatcher->getParam('id');
        $id = $this->filter->sanitize($id, 'int');

        $phone = PhoneBooks::findFirst($id);

        if ($phone instanceof PhoneBooks) {
            if ($phone->delete() === false) {
                $messages = $phone->getMessages();
                foreach ($messages as $message) {
                    $this->_response['messages'][] = $message->__toString();
                }

                $this->_response['statusCode'] = 409;
                $this->_response['status'] = 'error';
            } else {
                $this->_response['statusCode'] = 204;
                $this->_response['status'] = 'No Content';
            }
        } else {
            $this->_response['statusCode'] = 404;
            $this->_response['status'] = 'Not found';
        }
    }
}
