<?php

namespace Ongoing\CamtParser;

use Ongoing\CamtParser\Classes\Address;
use Ongoing\CamtParser\Classes\Entry;
use Ongoing\CamtParser\Classes\SimpleAddress;
use Ongoing\CamtParser\Classes\Transaction;
use Ongoing\CamtParser\Classes\TransactionCode;
use \SimpleXMLElement;

/**
 * Class CamtParser
 */
class CamtParser
{
    /** @var string */
    private $xmlPath;

    /** @var array */
    private $data;

    /**
     * CamtParser constructor.
     * @param $xmlPath
     */
    public function __construct($xmlPath) {
        $this->xmlPath = $xmlPath;
        $this->data = array();
    }

    /**
     * Parse the file set in the constructor
     * @return array
     */
    public function parse() {
        $file = simplexml_load_file($this->xmlPath);

        $account = (string)$file->BkToCstmrDbtCdtNtfctn->Ntfctn->Ntry->NtryRef;

        /**
         * Parse each transaction record
         */
        foreach ($file->BkToCstmrDbtCdtNtfctn->Ntfctn->Ntry as $entry) {
            $this->data[] = $this->parseEntry($entry, $account);
        }

        return $this->data;
    }

    /**
     * @param SimpleXMLElement $entry
     * @param $account
     * @return Entry
     */
    private function parseEntry(SimpleXMLElement $entry, $account) {
        $entryModel = new Entry();
        $entryModel->setTransactionCode($this->parseTransactionCode($entry->BkTxCd));

        /** set entry reference if available */
        if (isset($entry->NtryRef)) {
            $entryModel->setReference((string)$entry->NtryRef);
        }

        foreach ($entry->NtryDtls->TxDtls as $txDtl) {
            $entryModel->addTransaction($this->parseTransaction($txDtl, $account, $entryModel));
        }

        return $entryModel;
    }

    /**
     * @param SimpleXMLElement $transaction
     * @param $account
     * @param Entry $entry
     * @return Transaction
     * @internal param SimpleXMLElement $record
     */
    private function parseTransaction(SimpleXMLElement $transaction, $account, Entry $entry) {
        $transactionModel = new Transaction();

        $transactionModel->setCurrency((string)$transaction->Amt['Ccy']);
        $transactionModel->setAmount((float)$transaction->Amt);
        $transactionModel->setReferenceNumber((string)$transaction->RmtInf->Strd->CdtrRefInf->Ref);
        $transactionModel->setCharges((float)$transaction->Chrgs->TtlChrgsAndTaxAmt);
        $transactionModel->setAccount($account);
        $transactionModel->setEntry($entry);

        /** check for transaction datetime */
        if ($transaction->RltdDts->AccptncDtTm) {
            $transactionModel->setDatetime(new \DateTime((string)$transaction->RltdDts->AccptncDtTm));
        }

        /** set reject code if available */
        if (isset($transaction->RmtInf->Strd->AddtlRmtInf)) {
            $transactionModel->setRejectCode(str_replace('?REJECT?', '', (string)$transaction->RmtInf->Strd->AddtlRmtInf));
        }

        /** parse transaction code if available */
        if (isset($transaction->BkTxCd)) {
            $transactionModel->setTransactionCode($this->parseTransactionCode($transaction->BkTxCd));
        }

        /** parse the senders address */
        if (isset($transaction->RltdPties->Dbtr->PstlAdr)) {
            $transactionModel->setAddress($this->parseAddress($transaction->RltdPties->Dbtr->PstlAdr));
        }

        return $transactionModel;
    }

    /**
     * Parse the transaction code (must on entry, optional on transaction)
     * @param $transactionCode
     * @return TransactionCode
     */
    private function parseTransactionCode($transactionCode) {
        $transactionCodeModel = new TransactionCode();
        $transactionCodeModel->setDomain((string)$transactionCode->Domn->Cd);
        $transactionCodeModel->setFamily((string)$transactionCode->Domn->Fmly->Cd);
        $transactionCodeModel->setSubfamily((string)$transactionCode->Domn->Fmly->SubFmlyCd);

        return $transactionCodeModel;
    }

    /**
     * Parse the address block
     * It could be a structured address or just multiple lines
     *
     * @param SimpleXMLElement $addressBlock
     * @return Address|SimpleAddress
     */
    private function parseAddress(SimpleXMLElement $addressBlock) {
        if (isset($addressBlock->AdrLine)) {
            $address = new SimpleAddress();
            $address->setCountry((string)$addressBlock->Ctry);
            foreach ($addressBlock->AdrLine as $adrLine) {
                $address->addLine((string)$adrLine);
            }
        } else {
            $address = new Address();
            $address->setStreet((string)$addressBlock->StrtNm);
            $address->setStreetNumber((string)$addressBlock->BldgNb);
            $address->setPostalCode((string)$addressBlock->PstCd);
            $address->setTown((string)$addressBlock->TwnNm);
            $address->setCountry((string)$addressBlock->Ctry);
        }

        return $address;
    }

}