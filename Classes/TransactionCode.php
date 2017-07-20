<?php

namespace Ongoing\CamtParser\Classes;


/**
 * Class TransactionCode
 * @package Ongoing\CamtParser\Classes
 */
class TransactionCode
{
    /** @var string */
    private $domain;

    /** @var string */
    private $family;

    /** @var string */
    private $subfamily;

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param string $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return string
     */
    public function getSubfamily()
    {
        return $this->subfamily;
    }

    /**
     * @param string $subfamily
     */
    public function setSubfamily($subfamily)
    {
        $this->subfamily = $subfamily;
    }

}