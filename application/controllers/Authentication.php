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




}