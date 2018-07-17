<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_lib {

    
    public function __construct()
    {
      $this->ci =& get_instance();
    }
    

 
    public function sendMail($ext=array(), $data=array()) {
        $this->ci->load->library('email');
        $config['protocol']  = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "ISI EMAIL";
        $config['smtp_pass'] = "ISI PASSWORD";
        $config['charset']   = "utf-8";
        $config['mailtype']  = "html";
        $config['newline']   = "\r\n";
        
        
        $this->ci->email->initialize($config);
 
        $this->ci->email->from('noreply@kadooku.dev', 'Kadooku Indonesia');
        $this->ci->email->to($ext['email']);
        $this->ci->email->subject($ext['subject']);
        $body = $this->ci->load->view('email/newsletter.php',$data,TRUE);
        $this->ci->email->message($body); 
        if ($this->ci->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->ci->email->print_debugger());
        }
    }

}