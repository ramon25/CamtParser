<?php

namespace Ongoing\CamtParser\Classes;


use DateTime;

/**
 * Class Transaction
 * @package Ongoing\CamtParser\Classes
 */
class Transaction
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

    /** @var float */
    private $charges;

    /** @var string */
    private $account;

    /** @var TransactionCode */
    private $transactionCode;

    /** @var Entry */
    private $entry;

    /** @var string */
    private $rejectCode;

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

    /**
     * @return float
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * @param float $charges
     */
    public function setCharges($charges)
    {
        $this->charges = $charges;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return TransactionCode
     */
    public function getTransactionCode()
    {
        if (!$this->transactionCode) {
            return $this->getEntry()->getTransactionCode();
        }
        return $this->transactionCode;
    }

    /**
     * @param TransactionCode $transactionCode
     */
    public function setTransactionCode(TransactionCode $transactionCode)
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * @return Entry
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param Entry $entry
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
    }

    /**
     * @return string
     */
    public function getRejectCode()
    {
        return $this->rejectCode;
    }

    /**
     * @param string $rejectCode
     */
    public function setRejectCode($rejectCode)
    {
        $this->rejectCode = $rejectCode;
    }


}