<?php
    class APP {
        public $pages = Array(
            "GET" => Array(),
            "POST" => Array(),
            "ANY" => Array()
        );

        public function GET(string $url, object $handle) {
            $this -> pages['GET'][$url] = $handle;
        }

        public function POST(string $url, object $handle) {
            $this -> pages['POST'][$url] = $handle;
        }

        public function ANY(string $url, object $handle) {
            $this -> pages['ANY'][$url] = $handle;
        }

        public function is_set(string $url, string $type) {
            return isset($this -> pages[$type][$url]);
        }

        public function print_page(string $url, string $type) {
            $this -> pages[$type][$url]();
        }
    }

    function abort(int $code) {
        while (ob_get_level()) ob_end_clean();
        $id = $code;
        include '../pages/error.php';
        exit;
    }

    function db_load() {
        include_once '../module/DB.php';
    }

    function mail_load() {
        include_once '../module/mail.php';
    }
?>