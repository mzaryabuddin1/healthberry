<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->checksession->validatesession();
    $_SESSION['user_roles'] == 'admin' ? $this->load->view('dashboard_view') : $this->load->view('user_dashboard_view');
  }

}


