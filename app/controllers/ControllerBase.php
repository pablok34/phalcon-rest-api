<?php

namespace PhoneBookAPI\Controllers;

use Phalcon\Mvc\Controller;

use Phalcon\Mvc\Model\MetaData\Memory;

class ControllerBase extends Controller
{
    protected $_response;

    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        $this->view->disable();

        $this->response->setStatusCode($this->_response['statusCode'], $this->_response['status']);
        $this->response->setHeader('Access-Control-Allow-Origin', '*');

        $this->response->setContentType('application/json', 'UTF-8');

        return $this->response->setJsonContent($this->_response)->send();
    }

    public function getPaginationParams() : array
    {
        $params = [];

        $params['limit'] = $this->request->getQuery('limit', 'int', 10);
        $params['offset'] = $this->request->getQuery('offset', 'int', 0);
        $params['total'] = 0;

        return $params;
    }

    public function getFilltersConditionsForModel($model)
    {
        $filtersConditions = [];
        $metaData = new Memory();
        $dataTypes = $metaData->getDataTypes($model);

        //get only string fields https://docs.phalconphp.com/3.4/en/api/Phalcon_Db_Column
        $stringAttributes = [];
        foreach ($dataTypes as $key => $type) {
            if ($type === \Phalcon\Db\Column::TYPE_VARCHAR) {
                $stringAttributes[] = $key;
            }
        }

        //check if the attribute is present on the query
        foreach ($stringAttributes as $stringAttribute) {
            if ($this->request->hasQuery($stringAttribute)) {
                $value = $this->request->getQuery($stringAttribute, 'string');
                if (!is_null($value)) {
                    $filtersConditions['conditions'] = $stringAttribute . " LIKE :value:";
                    $filtersConditions['bind'] = ['value' => $value . '%'];
                }
            }
        }

        return $filtersConditions;
    }

    public function getFieldsFromRequestForModel($model)
    {
        $fieldsFromRequest = $this->request->getJsonRawBody(true);

        $metaData = new Memory();
        $attributes = $metaData->getAttributes($model);

        $result = array_intersect_key($fieldsFromRequest, array_flip($attributes));

        return $result;
    }
}
