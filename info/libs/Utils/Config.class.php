<?php

class Config
{
    public $file = null;
    public $config = null;

    public function __construct()
    {
        $this->_checkPHPVersion(5.3);

        $this->file = __DIR__.'/../../esm.config.json';

        if (!file_exists($this->file))
            throw new \Exception('Config file '.basename($this->file).' not found');

        $this->_readFile();
    }

    private function _readFile()
    {
        $content = file_get_contents($this->file);
        $this->config = json_decode(utf8_encode($content), true);

        if ($this->config == null && json_last_error() != JSON_ERROR_NONE)
        {
            throw new \LogicException(sprintf("Failed to parse config file '%s'. Error: '%s'", basename($this->file) , json_last_error_msg()));
        }
    }


    /**
     * Returns a specific config variable
     * Ex : get('ping:hosts')
     */
    public function get($var)
    {
        $tab = $this->config;
        
        $explode = explode(':', $var);
        
        foreach ($explode as $vartmp)
        {
            if (isset($tab[$vartmp]))
            {
                $tab = $tab[$vartmp];
            }
        }

        return $tab == $this->config ? null : $tab;
    }
    
    
    /**
     * Returns all config variables
     */
    public function getAll()
    {
        return $this->config;
    }


    /**
     * Checks the PHP version compared to the required version
     */
    private function _checkPHPVersion($min)
    {
        if (!version_compare(phpversion(), $min, '>='))
            throw new \Exception('Your PHP version is too old ! PHP '.$min.' is required.');

        return true;
    }
}


// PHP 5.5.0
if (!function_exists('json_last_error_msg'))
{
    function json_last_error_msg()
    {
        static $errors = array(
            JSON_ERROR_NONE             => null,
            JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
            JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
            JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );
        $error = json_last_error();
        return array_key_exists($error, $errors) ? $errors[$error] : "Unknown error ({$error})";
    }
}