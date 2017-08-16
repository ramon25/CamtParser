<?php

namespace Ongoing\CamtParser\Classes;

class SimpleAddress
{

    /** @var string */
    private $country;

    /** @var array */
    private $lines = array();

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param array $lines
     * @return $this
     */
    public function setLines($lines)
    {
        $this->lines = $lines;

        return $this;
    }

    /**
     * @param string $line
     * @return $this
     */
    public function addLine($line) {
        $this->lines[] = $line;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
}