<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';


class Authentication extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

        // Emailer
        $this->load->library('emailsender');
        $this->load->model('Authentication_model', "Model");
        
    }

    
    public function index()
    {
        $this->load->view('login_view');
    }

    
    public function forgot_password()
    {
        $this->load->view('forgot_password_view');
    }
    
    public function forgot_password_submit()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        // if ($this->form_validation->run() == false) {
        //     $errors = array('error' => validation_errors());
		// 	print_r(json_encode($errors));
		// 	exit;
        // }


        $information = $this->security->xss_clean($this->input->get());

        // print_r($information);
        // exit;

        $email = $information['email'];
        $subject = "My subject";
        $message = "My message";
        $is_email_sent = $this->emailsender->sendEmail($email, $subject, $message);

        if(!$is_email_sent){
            $errors = array('error' => '<p>Error while sending email!.</p>');
			print_r(json_encode($errors));
			exit; 
        }

        $otp = rand(111111, 999999);

        $result = true;

        if ($result) {
			$success = array('success' => 1);
			print_r(json_encode($success));
			exit;
		} else {
			$errors = array('error' => '<p>Error while saving record!.</p>');
			print_r(json_encode($errors));
			exit;
		}


    }




}