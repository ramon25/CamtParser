<?php

namespace Ongoing\CamtParser\Classes;


/**
 * Class Entry
 */
class Entry
{
    /**
     * Entry constructor.
     */
    public function __construct()
    {
        $this->transactions = [];
    }

    /** @var array */
    private $transactions;

    /** @var TransactionCode */
    private $transactionCode;

    /** @var string */
    private $reference;

    /**
     * @return array
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param array $transactions
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @param Transaction $transaction
     */
    public function addTransaction(Transaction $transaction) {
        $this->transactions[] = $transaction;
    }

    /**
     * @return TransactionCode
     */
    public function getTransactionCode()
    {
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
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }
}