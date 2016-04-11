<?php

/**
 * This class handles the SMTP mail
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 * @subpackage : SMTP Mailer
 */

namespace Scrawler;

class Mail {

    //---------------------------------------------------------------// 
    /**
     * Stores the senders email id
     * @var string
     */
    protected $smtp;

    /**
     * Stores the senders email id
     * @var string
     */
    protected $from = array();

    /**
     * Stores the recivers email id 
     * @var string
     */
    protected $to = array();

    /**
     * Stores the recivers email id 
     * @var string
     */
    protected $subject;

    /**
     * Stores the SMTP host
     * @var string
     */
    protected $host;

    /**
     * Stores the SMTP port 
     * @var string
     */
    protected $port;

    /**
     * Stores the SMTP username  
     * @var string
     */
    protected $username;

    /**
     * Stores the SMTP password 
     * @var string
     */
    protected $password;

    /**
     * Stores the message to be send
     * @var string
     */
    protected $body;

    /**
     * Stores the senders email id
     * @var string
     */
    protected $CRLF = "\r\n";

    //---------------------------------------------------------------//

    /**
     * constructor overloading for auto routing
     */
    function __construct() {

        $config = parse_ini_file(__DIR__ . '/../../App/config.ini');
        $this->host = $config['Smtphost'];
        $this->port = $config['Smtpport'];
        $this->username = $config['Smtpuser'];
        $this->password = $config['Smtppass'];
    }

    //---------------------------------------------------------------//
    /**
     * This functions sends the mail
     */
    public function send($from = array(), $to = array(), $subject, $body) {
        $this->from = $from;
        $this->to = $to;
        $this->body = $body;
        $this->subject = $subject;
        $msg = $this->message();

        $this->smtp = @fsockopen($this->host, $this->port);
        if (!$this->smtp) {
            $this->push("AUTH LOGIN" . $this->CRLF);
            $this->push(base64_encode($this->username) . $this->CRLF);
            $code = $this->push(base64_encode($this->password) . $this->CRLF);

            if ($code === '235') {
                foreach ($this->from as $key => $value) {
                    $fromemail = $value;
                }
                $this->push("MAIL FROM:<" . $fromemail . ">" . $this->CRLF);
                foreach ($this->to as $key => $value) {
                    $this->push("RCPT TO:<" . $value . ">" . $this->CRLF);
                }
                $this->push("DATA" . $this->CRLF);
                $code = $this->push($msg);
                if ($code === '250') {
                    $this->push("QUIT" . $this->CRLF);
                    return fclose($this->smtp);
                } else {
                    echo "could not send the email ";
                }
            } else {

                echo "could not authenticate with given username and password";
            }
        } else {
            echo "could not connect to SMTP server";
        }

        return fclose($this->smtp);
    }

    //---------------------------------------------------------------//

    /**
     * This function pushes the command to server and gets the response code
     */
    protected function push($command) {
        fputs($this->smtp, $command, strlen($command));
        while ($str = fgets($this->smtp, 515)) {
            if (substr($str, 3, 1) == " ") {
                $code = substr($str, 0, 3);
                return $code;
            }
        }
    }

    //---------------------------------------------------------------//

    /**
     * This function prepares msessage
     */
    protected function message() {
        $msg = '';
        $msg .= 'Date :' . date('r') . $this->CRLF;
        foreach ($this->from as $key => $value) {
            $fromemail = $value;
            $fromname = $key;
        }
        $msg .= 'From :' . $fromname . "<" . $fromemail . ">" . $this->CRLF;
        foreach ($this->to as $key => $value) {
            $to .= $key . "<" . $value . ">,";
        }
        $msg .= 'To :' . $to . $this->CRLF;
        $msg .= 'Subject :' . $this->subject . $this->CRLF;
        $msg .= 'Message-ID :' . '<' . md5('Scrawler' . md5(time()) . uniqid()) . '@' . $fromemail . '>' . $this->CRLF;
        $msg .= 'X-Priority : 3' . $this->CRLF;
        $msg .= 'X-Mailer : Scrawler (https://github.com/GoStalk/Scrawler)' . $this->CRLF;
        $msg .= 'MIME-Version : 3.0 ' . $this->CRLF;
        $boundary = md5(md5(time() . 'Scrawler') . uniqid());
        $msg .= "Content-Type: multipart/alternative; boundary=\"" . $boundary . "\"" . $this->CRLF;
        $msg .= $this->CRLF;
        $msg .= "--" . $boundary . $this->CRLF;
        $msg .= "Content-Type: text/plain; charset=\"UTF-8\"" . $this->CRLF;
        $msg .= "Content-Transfer-Encoding: base64" . $this->CRLF;
        $msg .= $this->CRLF;
        $msg .= chunk_split(base64_encode($this->body)) . $this->CRLF;
        $msg .= $this->CRLF;
        $msg .= "--" . $boundary . $this->CRLF;
        $msg .= "Content-Type: text/html; charset=\"UTF-8\"" . $this->CRLF;
        $msg .= "Content-Transfer-Encoding: base64" . $this->CRLF;
        $msg .= $this->CRLF;
        $msg .= chunk_split(base64_encode($this->body)) . $this->CRLF;
        $msg .= $this->CRLF;
        $msg .= "--" . $boundary . "--" . $this->CRLF;
        $msg .= $this->CRLF . $this->CRLF . "." . $this->CRLF;
        return $msg;
    }

    //---------------------------------------------------------------//     
}
