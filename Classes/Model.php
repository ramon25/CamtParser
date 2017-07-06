<?php

namespace Ongoing\CamtParser\Classes;

use DateTime;

/**
 * Class Model
 */
class Model
{

    /** @var string */
    private $referenceNumber;

    /** @var float */
    private $amount;

    /** @var string */
    private $currency;

    /** @var DateTime */
    private $datetime;

    /** @var Address|SimpleAddress */
    private $address;

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $referenceNumber
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return Address|SimpleAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address|SimpleAddress $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

}