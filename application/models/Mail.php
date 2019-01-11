<?php

/* * ***
 * Version: V1.0.1
 *
 * Description of Mail model
 *
 * @author Anon D.
 *
 * @email  acework2u@gmail.com
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends CI_Model
{

    // Declaration of a variables
    private $_mailTo;
    private $_mailFrom;
    private $_mailSubject;
    private $_mailContent;
    private $_templateName;
    private $_templatePath;

    //Declaration of a methods
    public function setMailTo($mailTo)
    {
        $this->_mailTo = $mailTo;
    }

    public function setMailFrom($mailFrom)
    {
        $this->_mailFrom = $mailFrom;
    }

    public function setMailSubject($mailSubject)
    {
        $this->_mailSubject = $mailSubject;
    }

    public function setMailContent($mailContent)
    {
        $this->_mailContent = $mailContent;
    }

    public function setTemplateName($templateName)
    {
        $this->_templateName = $templateName;
    }

    public function setTemplatePath($templatePath)
    {
        $this->_templatePath = $templatePath;
    }

    // smtpMail

    public function sendMail($data)
    {

        //Load email library
        $this->load->library('email');

        if (!empty($data) && $data == 'smtp') {
            //SMTP & mail configuration
            $config = array(
                'protocol' => PROTOCOL,
                'smtp_host' => SMTP_HOST,
                'smtp_port' => SMTP_PORT,
                'smtp_user' => SMTP_USER,
                'smtp_pass' => SMTP_PASS,
                'mailtype' => MAILTYPE,
                'charset' => CHARSET,
            );

            $fullPath = $this->_templatePath . $this->_templateName;
            $this->email->initialize($config);
            $this->email->set_mailtype(MAILTYPE);
            $this->email->set_newline("\r\n");

            //Email content
            $mailMessage = $this->load->view($fullPath, $this->_mailContent, TRUE);
            $this->email->to($this->_mailTo);
            $this->email->from($this->_mailFrom, FROM_TEXT);
            $this->email->subject($this->_mailSubject);
            $this->email->message($mailMessage);
            //Send email
            if ($this->email->send()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }


    public function send2Mail($data)
    {
        $this->load->library("PHPMailer_Library");

        $mail_send_flg = false;
        if (!is_blank($data) && $data == "smtp") {


            $mail = $this->phpmailer_library->load();
            $mail->isSMTP();
            $mail->IsHTML(true);
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.saijo-denki.co.th";        // sets hotmil as the SMTP server
            $mail->Port = 465;                    // set the SMTP port for the hotmail server
            $mail->Timeout = 30;
            $mail->CharSet = "utf-8";
            $mail->SMTPOptions = array(
                'ssl' => [
                    'verify_peer' => false,
                    'peer_name' => 'mail.saijo-denki.net',
                ],
            );

            $mail->Username = "saijoapp@saijo-denki.co.th";      // hotmail username
            $mail->Password = "WjiHk2Jz";           // hotmail password


            /***** Email Content ****/


            $fullPath = $this->_templatePath.$this->_templateName;
            $mailMessage = $this->load->view($fullPath, $this->_mailContent, TRUE);


            $mail->SetFrom('saijoapp@saijo-denki.co.th', 'Saijo Denki App');
            $mail->Subject = "Please Confirm email user registration";
//            $mail->MsgHTML($this->_mailContent);
            $mail->MsgHTML($mailMessage);
            $mail->AddAddress($this->_mailTo, "Customer");

            if (!$mail->Send()) {
//            echo "Mailer Error: " . $mail->ErrorInfo;
                $mail_send_flg = false;
            } else {
//            echo "Message sent!";
                $mail_send_flg = true;
            }
        }


        return $mail_send_flg;
    }

    // generate Unique UserName
    public function generateUnique($tableName, $string, $field, $key = NULL, $value = NULL)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '', strtolower($string));
        $i = 0;
        $params = array();
        $params[$field] = $slug;
        if ($key)
            $params["$key !="] = $value;
        while ($this->db->where($params)->get($tableName)->num_rows()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            $params [$field] = $slug;
        }
        return $slug;
    }

}

?>
