<?php

namespace Ongoing\CamtParser;

use Ongoing\CamtParser\Classes\Address;
use Ongoing\CamtParser\Classes\Model;
use Ongoing\CamtParser\Classes\SimpleAddress;
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
     * @return array
     */
    public function parse() {
        $file = simplexml_load_file($this->xmlPath);

        $account = (string)$file->BkToCstmrDbtCdtNtfctn->Ntfctn->Ntry->NtryRef;

        /** @var SimpleXMLElement $txDtl */
        foreach ($file->BkToCstmrDbtCdtNtfctn->Ntfctn->Ntry->NtryDtls->TxDtls as $txDtl) {
            $this->data[] = $this->parseRecord($txDtl, $account);
        }

        return $this->data;
    }

    /**
     * @param SimpleXMLElement $record
     * @return Model
     */
    private function parseRecord(SimpleXMLElement $record, $account) {
        $model = new Model();
        $model->setCurrency((string)$record->Amt['Ccy']);
        $model->setAmount((float)$record->Amt);
        $model->setReferenceNumber((string)$record->RmtInf->Strd->CdtrRefInf->Ref);
        $model->setDatetime(new \DateTime((string)$record->RltdDts->AccptncDtTm));
        $model->setCharges((float)$record->Chrgs->TtlChrgsAndTaxAmt);
        $model->setAccount($account);

        if (isset($record->RltdPties->Dbtr->PstlAdr)) {
            $model->setAddress($this->parseAddress($record->RltdPties->Dbtr->PstlAdr));
        }

        return $model;
    }

    /**
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