<?php
/*
* INTER-Mediator Ver.5.1-dev Released 2015-04-24
*
*   Copyright (c) 2010-2015 INTER-Mediator Directive Committee, All rights reserved.
*
*   This project started at the end of 2009 by Masayuki Nii  msyk@msyk.net.
*   INTER-Mediator is supplied under MIT License.
*/

class DB_Logger
{
    /* Debug and Messages */
    private $debugLevel = false;
    private $errorMessage = array();
    private $debugMessage = array();

    public function setDebugMessage($str, $level = 1)
    {
        if ($this->debugLevel !== false && $this->debugLevel >= $level) {
            $this->debugMessage[] = $str;
        }
    }

    public function setErrorMessage($str)
    {
        $this->errorMessage[] = $str;
    }

    function getMessagesForJS()
    {
        $q = '"';
        $returnData = array();
        foreach ($this->errorMessage as $oneError) {
            $returnData[] = "INTERMediator.setErrorMessage({$q}"
                . str_replace("\n", " ", addslashes($oneError)) . "{$q});";
        }
        foreach ($this->debugMessage as $oneError) {
            $returnData[] = "INTERMediator.setDebugMessage({$q}"
                . str_replace("\n", " ", addslashes($oneError)) . "{$q});";
        }
        return $returnData;
    }

    public function getErrorMessages()
    {
        return $this->errorMessage;
    }

    public function getDebugMessages()
    {
        return $this->debugMessage;
    }

    function getAllErrorMessages()
    {
        $returnData = "";
        foreach ($this->errorMessage as $oneError) {
            $returnData .= "{$oneError}\n";
        }
        return $returnData;
    }

    public function setDebugMode($val)
    {
        if ($val === true) {
            $this->debugLevel = 1;
        } else {
            $this->debugLevel = $val;
        }
    }

    public function getDebugMessage()
    {
        return $this->debugMessage;
    }

    public function getDebugLevel()
    {
        return $this->debugLevel;
    }
}
