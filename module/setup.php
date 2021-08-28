<?php
    function make_word($n) {
        $r = "";
        $s = "qwertyuiopasdfghjklzxcvbnm_1234567890";

        while($n--) $r .= $s[rand(0, strlen($s) - 1)];

        return $r;
    }

    class Setup {
        public $ini_client = null;
        public $ini_setting = null;

        function __construct($ini_client) {
            $this -> set_ini_client($ini_client);
            $this -> read_ini_data();
        }

        public function check_admin() {
            return $_SERVER['SERVER_NAME'] == $this -> ini_setting['APP_HOST'];
        }

        public function set_ini_client($client) {
            $this -> ini_client = $client;
        }

        public function read_ini_data() {
            $this -> ini_client -> read_ini();
            $this -> ini_setting = $this -> ini_client -> data;
            return $this -> ini_setting;
        }

        public function setup() {
            if (trim($this -> ini_setting['APP_NAME']) == "") $this -> ini_setting['APP_NAME'] = make_word(rand(5, 10));
            $this -> ini_setting['APP_KEY'] = hash_pbkdf2('sha256', $this -> ini_setting['APP_NAME'], 'nomu', 100, 15, false);

            $this -> ini_client -> data = $this -> ini_setting;
            $this -> ini_client -> save_ini();

            echo "aleum setup success";
            echo "<p>APP_NAME: {$this -> ini_client -> data['APP_NAME']}</p>";
        }
    }
?>