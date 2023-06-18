<?php 

namespace App\Services\Phpmailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    // protected ApiClient $client
    private PHPMAILER $mail;

    private string $mailTo;
    private string $subject;
    private string $body;

    public function __construct($mailTo, $subject, $body){
        $this->mail    = new PHPMailer(true);

        $this->mailTo  = $mailTo;
        $this->subject = $subject;
        $this->body    = $body;
    }

    public function send(){
        $mail = $this->mail;

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = env('PHPMAILER_HOST');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

            $mail->Username   = env('PHPMAILER_USERNAME');                     //SMTP username
            $mail->Password   = env('PHPMAILER_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(env('PHPMAILER_WEBMAIL'), env('PHPMAILER_WEBMAIL_NAME'));
            $mail->addReplyTo(env('PHPMAILER_WEBMAIL'), env('PHPMAILER_WEBMAIL_NAME'));
            $mail->addCC($this->mailTo);
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
        
            $mail->send();

            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}


