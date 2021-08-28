<?php
    class INI {
        public $data = Array();
        public $config_file="../config.ini";

        function __construct() {
            $this -> read_ini();
        }

        public function read_ini() {
            $this -> data = parse_ini_file($this -> config_file);
        }

        public function save_ini() {
            $data = file_get_contents($this -> config_file);

            foreach ($this -> data as $key => $value) {
                $value = trim($value);
                $h = "/{$key}=[^\n]*\n?/";
                $r = "{$key}={$value}\n";
                $data = preg_replace($h, $r, $data);
            }

            file_put_contents($this -> config_file, $data);
        }

        public function setErrorLevel() {
            $error = Array(0, E_ERROR, E_ERROR | E_WARNING, E_ERROR | E_WARNING | E_PARSE, E_ERROR | E_WARNING | E_PARSE | E_NOTICE, E_ALL);
            error_reporting($error[$this -> data['ERROR_REPORTING']]);
            ini_set('display_errors', $this -> data['DISPLAY_ERROR']);
        }
    }
?>