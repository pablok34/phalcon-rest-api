<?php

namespace PhoneBookAPI\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Callback as CallbackValidator;

use PhoneBookAPI\Validators\Country as CountryValidator;
use PhoneBookAPI\Validators\Timezone as TimezoneValidator;

class PhoneBooks extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $firstName;

    /**
     *
     * @var string
     */
    protected $lastName;

    /**
     *
     * @var integer
     */
    protected $phoneNumber;

    /**
     *
     * @var string
     */
    protected $countryCode;

    /**
     *
     * @var string
     */
    protected $timezone;

    /**
     *
     * @var string
     */
    protected $insertedOn;

    /**
     *
     * @var string
     */
    protected $updatedOn;

    /**
     * Method to set the value of field firstName
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName) : PhoneBooks
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Method to set the value of field lastName
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName) : PhoneBooks
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Method to set the value of field phoneNumber
     *
     * @param integer $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(int $phoneNumber) : PhoneBooks
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Method to set the value of field countryCode
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode) : PhoneBooks
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Method to set the value of field timezone
     *
     * @param string $timezone
     * @return $this
     */
    public function setTimezone($timezone) : PhoneBooks
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Method to set the value of field insertedOn
     *
     * @param string $insertedOn
     * @return $this
     */
    public function setInsertedOn($insertedOn) : PhoneBooks
    {
        $this->insertedOn = $insertedOn;

        return $this;
    }

    /**
     * Method to set the value of field updatedOn
     *
     * @param string $updatedOn
     * @return $this
     */
    public function setUpdatedOn($updatedOn) : PhoneBooks
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the value of field firstName
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * Returns the value of field lastName
     *
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * Returns the value of field phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber() : int
    {
        return $this->phoneNumber;
    }

    /**
     * Returns the value of field countryCode
     *
     * @return string
     */
    public function getCountryCode() : string
    {
        return $this->countryCode;
    }

    /**
     * Returns the value of field timezone
     *
     * @return string
     */
    public function getTimezone() : string
    {
        return $this->timezone;
    }

    /**
     * Returns the value of field insertedOn
     *
     * @return string
     */
    public function getInsertedOn() : string
    {
        return $this->insertedOn;
    }

    /**
     * Returns the value of field updatedOn
     *
     * @return string
     */
    public function getUpdatedOn() : string
    {
        return $this->updatedOn;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() : PhoneBooks
    {
        $this->setSchema("phone_books");
        $this->setSource("phone_books");

        $this->skipAttributes(
            [
                'id',
                'insertedOn',
                'updatedOn',
            ]
        );

        return $this;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() : string
    {
        return 'phone_books';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PhoneBooks[]|PhoneBooks|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PhoneBooks|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'countryCode',
            new CountryValidator(
                [
                    "message" => "Country code not valid"
                ]
            )
        );

        $validator->add(
            'timezone',
            new TimezoneValidator(
                [
                    "message" => "Timezone code not valid"
                ]
            )
        );

        return $this->validate($validator);
    }
}
