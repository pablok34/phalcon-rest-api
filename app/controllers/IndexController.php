<?php

namespace PhoneBookAPI\Controllers;

class IndexController extends ControllerBase
{
    public function route404Action()
    {
        $this->_response['statusCode'] = 404;
        $this->_response['status'] = 'Route not found';
    }

    public function route500Action()
    {
        $this->_response['statusCode'] = 500;
        $this->_response['status'] = 'Internal server error';
    }
}
