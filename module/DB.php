<?php
    class DB {
        public $conn = null;
        public $result = null;

        function __construct(string $host = "", string $id = "", string $pass = "", string $name = "") {
            GLOBAL $config;
            
            if ($host == "") $host = $config -> data['DB_HOST'];
            if ($id == "") $id = $config -> data['DB_ID'];
            if ($pass == "") $pass = $config -> data['DB_PASS'];
            if ($name == "") $name = $config -> data['DB_NAME'];

            $this -> conn = new mysqli($host, $id, $pass, $name);

            register_shutdown_function(function() {
                $this -> conn -> close();
            });
        }

        public function query(string $query, Array $data = array()) {
            $stmt = $this -> conn -> prepare($query);
            
            if (count($data) != 0) {
                $type = "";
                foreach ($data as $v) $type .= gettype($v)[0];
                $stmt -> bind_param($type, ...$data);
            }

            $stmt -> execute();
            $res = $stmt -> get_result();

            if ($res -> num_rows == 0) $this -> result = null;
            else {
                $this -> result = Array();
                while(($r = $res -> fetch_assoc()) !== null) $this -> result[] = $r;
            }

            $res -> close();
            $stmt -> close();

            return $this -> result;
        }

        public function insert(string $sql, Array $data) {
            $stmt = $this -> conn -> prepare($sql);
   
            if (count($data) != 0) {
                $type = "";
                foreach ($data as $v) $type .= gettype($v)[0];
                $stmt -> bind_param($type, ...$data);
            }

            $this -> result = $stmt -> execute();
            $stmt -> close();

            return $this -> result;
        }

        public function disconnect() {
            $this -> conn -> close();
        }
    }
?>