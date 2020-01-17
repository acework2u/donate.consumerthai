<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mailer
{

    protected $to;

    protected $subject;

    protected $userName;

    protected $password;

    protected $emailHost;

    protected $mailFrom;

    protected $mailDirectory;
    protected $fileAttach;
    protected $cc_mail;
    protected $cc_mail2;


    public function __construct()
    {

//        $this->userName = 'joeyfarms2@gmail.com';
//        $this->password = 'J@e2262527#';
        $this->userName = 'consumerthailand.official@gmail.com';
        $this->password = 'Joe2262527';
        $this->emailHost = 'smtp.gmail.com';
        $this->mailFrom = array('noreply@consumerthai.org' => 'donate.consumerthai.org');

        if ($_SERVER["SERVER_NAME"] == "donate-consumer.local") {
            /***Dev*****/
            $this->cc_mail = array('joeyfarms2@gmail.com' => "Have a user new donation to you", 'joeyfarms4@gmail.com' => 'Have a user new donation to you');
            $this->cc_mail2 = array('acework2u@gmail.com' => "Have a new donated");
        } else {
            /**Production**/
            $this->cc_mail = array('donationffc@gmail.com' => "Have a user new donation to you", "saowaluk_@hotmail.com.com" => "Have a user new donation to you");
            $this->cc_mail2 = array('tawanshinehuang@gmail.com' => "Have a user new donation to you");
        }


        // Define email directory
        $this->mailDirectory = VIEWPATH . '/emails';
    }


    protected function init()
    {
        $transport = (new Swift_SmtpTransport($this->emailHost, 465, 'ssl'))
            ->setUsername($this->userName)
            ->setPassword($this->password);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }


    protected function initializeTemplate($template, $__data)
    {

        ob_start();
        extract($__data);

        include $this->mailDirectory . '/' . $template;

        return ltrim(ob_get_clean());
    }


    public function to($email)
    {
        $this->to = $email;
        return $this;
    }


    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setAttachFile($fileAttach, $fileName = "Invoice.pdf")
    {

        $attachment = new Swift_Attachment($fileAttach, $fileName, 'application/pdf');
        $this->fileAttach = $attachment;
        return $this;
    }


    public function send($view, array $data = [])
    {
        // Initialize Swift Mailer
        $mailer = $this->init();
        $template = $this->initializeTemplate($view, $data);

        // Create a message

        if (!is_blank($this->fileAttach)) {
            $message = (new Swift_Message($this->subject))
                ->setFrom($this->mailFrom)
                ->setTo([$this->to])->setCc($this->cc_mail)->setBcc($this->cc_mail2)
                ->setBody($template, 'text/html')
                ->attach($this->fileAttach);
        } else {
            $message = (new Swift_Message($this->subject))
                ->setFrom($this->mailFrom)
                ->setTo([$this->to])->setCc($this->cc_mail)->setBcc($this->cc_mail2)
                ->setBody($template, 'text/html');
        }

        // Send the message
        $result = $mailer->send($message);
    }
}
