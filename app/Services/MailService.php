<?php

namespace App\Services;

use App\Core\Env;

class MailService {
    
    /**
     * Envoie un email via SMTP Gmail (Simulé ou Réel si PHPMailer est présent)
     */
    public static function send($to, $subject, $message) {
        $host = Env::get('SMTP_HOST');
        $port = Env::get('SMTP_PORT');
        $user = Env::get('SMTP_USER');
        $pass = Env::get('SMTP_PASS');
        $fromName = Env::get('SMTP_FROM_NAME') ?: 'COACKI';

        if (empty($host) || empty($user) || empty($pass)) {
            error_log("SMTP ERROR: Missing configuration in .env");
            return false;
        }

        $headers = "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <{$user}>\r\n";
        $headers .= "Reply-To: {$user}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $socket = fsockopen("ssl://" . $host, $port, $errno, $errstr, 5);
        if (!$socket) {
            error_log("SMTP Connect Error: $errstr ($errno)");
            return false;
        }
        stream_set_timeout($socket, 3); // 3 seconds timeout for reads

        $res = function($sock, $cmd = "") {
            $data = "";
            while($str = fgets($sock, 515)) {
                $data .= $str;
                if(substr($str,3,1) == " ") break;
            }
            if (empty($data)) error_log("SMTP timeout or empty after: " . $cmd);
            return $data;
        };

        $res($socket, "connect"); // Catch l'accueil 220
        fwrite($socket, "EHLO localhost\r\n");
        $res($socket, "EHLO");
        
        fwrite($socket, "AUTH LOGIN\r\n");
        $res($socket, "AUTH LOGIN");
        fwrite($socket, base64_encode($user) . "\r\n");
        $res($socket, "USER");
        fwrite($socket, base64_encode($pass) . "\r\n");
        $auth_res = $res($socket, "PASS");
        
        if (strpos($auth_res, '235') === false) {
            error_log("SMTP Auth Failed: " . $auth_res);
            fclose($socket);
            return false;
        }

        fwrite($socket, "MAIL FROM: <$user>\r\n");
        $res($socket, "MAIL FROM");
        
        fwrite($socket, "RCPT TO: <$to>\r\n");
        $res($socket, "RCPT TO");
        
        fwrite($socket, "DATA\r\n");
        $res($socket, "DATA");
        
        $msg = "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
        $msg .= $headers . "\r\n\r\n";
        $msg .= $message . "\r\n.\r\n";
        
        fwrite($socket, $msg);
        $res($socket, "MSG");
        
        fwrite($socket, "QUIT\r\n");
        $res($socket, "QUIT");
        fclose($socket);
        
        return true;
    }
}
