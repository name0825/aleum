<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    class MAIL {
        public $mailer = null;
        public $auth = null;
        public $debug = null;
        public $stmp_host = null;
        public $stmp_port = null;
        public $mail_address = null;
        public $user_name = null;
        public $password = null;
        public $secure = null;

        function __construct() {
            include_once '../module/PHPMailer/src/Exception.php';
            include_once '../module/PHPMailer/src/PHPMailer.php';
            include_once '../module/PHPMailer/src/SMTP.php';
            
            if (!isset($GLOBALS['config'])) {
                include_once '../module/ini.php';
                $config = new INI();
            }else $config = $GLOBALS['config'];

            $this -> mailer = new PHPMailer(true);
            $this -> debug = trim($config -> data['MAIL_DEBUG']);
            $this -> smtp_host = trim($config -> data['MAIL_HOST']);
            $this -> smtp_port = trim($config -> data['MAIL_PORT']);
            $this -> user_name = trim($config -> data['MAIL_USERNAME']);
            $this -> mail_address = trim($config -> data['MAIL_USERADDRESS']);
            $this -> password = trim($config -> data['MAIL_PASSWORD']);
            $this -> auth = trim($config -> data['MAIL_SMTPAUTH']);
            $this -> secure = trim($config -> data['MAIL_ENCRYPTION']);
        }

        public function send(Array $to, bool $is_html, string $sub, string $body, Array $from = array()) {
            try {
                if (!isset($from[0], $from[1])) $from = Array($this -> mail_address, $this -> user_name);

                $mailer = $this -> mailer;
                $mailer -> SMTPDebug = (int)($this -> debug);
                $mailer -> isSMTP();

                $mailer -> CharSet = "utf-8";
                $mailer -> Host = $this -> smtp_host;
                $mailer -> SMTPAuth = (bool)($this -> auth);
                $mailer -> Username = $this -> mail_address;
                $mailer -> Password = $this -> password;
                $mailer -> SMTPSecure = $this -> secure;
                $mailer -> Port = $this -> smtp_port;

                $mailer -> From = $from[0];
                $mailer -> FromName = $from[1];

                $mailer -> setFrom($from[0], $from[1]);
                $mailer -> addAddress($to[0], $to[1]);

                $mailer -> isHTML = $is_html;
                $mailer -> Subject = $sub;
                $mailer -> Body = $body;

                $mailer -> send();

                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }
?>