<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->checksession->validatesession();
    if($_SESSION['user_roles'] != 'admin'){ header("Location: " . base_url() . 'login?error=Unauthorized Access'); }
  }

  public function index()
  {
    $this->load->view('manage_doctor_view');
  }

}
