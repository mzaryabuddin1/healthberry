<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Appuser extends CI_Controller
{
  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Appuser_model');
  }

  public function index()
  {
    $this->load->view("app_login_view");
  }
  
  public function checksession()
	{
		if ( !isset($_SESSION['app_user_id']) || empty($_SESSION['app_user_id']) ) {
			header("Location: " . base_url() . 'login-app-user?err=Please Login First');
			exit;
		}
	}

  public function login_submit()
  {
    //VALIDATE FORM
    $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');

    if ($this->form_validation->run() == false) {
      $errors = array('error' => validation_errors());
      print_r(json_encode($errors));
      exit;
    }

    $this->__currentdatetime = date("Y-m-d H:i:s", time());

    $information = $this->security->xss_clean($this->input->post());
    $this->data['username'] = $information['username'];
    $this->data['password'] = md5($information['password']);

    $isAvailable = $this->Appuser_model->login_submit($this->data);

    if (sizeof($isAvailable) > 0) {
      if (!$isAvailable[0]['status']) {
        $errors = array('error' => '<p>Your account is blocked!.</p>');
        print_r(json_encode($errors));
        exit;
      }


      $_SESSION['app_user_id'] = $isAvailable[0]['id'];
      $_SESSION['app_user_profile_picture'] = $isAvailable[0]['profile_picture'];
      $_SESSION['app_user_username'] = $isAvailable[0]['username'];


      $success = array('success' => 1);
      print_r(json_encode($success));
      exit;
    } else {
      $errors = array('error' => '<p>Combination Does Not Exists<br>Please check username and password!.</p>');
      print_r(json_encode($errors));
      exit;
    }
  }

  public function logout()
  {
    unset($_SESSION['app_user_id']);
		session_destroy();
		header("Location: " . base_url() . 'login-app-user');
  }

  public function dashboard()
  {
    $this->checksession();
    $this->data['plan'] = $this->Appuser_model->get_plan($_SESSION['app_user_id']);
    $this->load->view("app_dashboard_view", $this->data);
  }

  public function doctor_location()
  {
    $this->checksession();
    $params['app_user_id'] = $_SESSION['app_user_id'];
    $params['plan_id'] = $_GET['id'];
    $this->data['plan'] = $this->Appuser_model->get_doctor_location_by_plan_id($params);
    $this->load->view("app_view_doctor_location", $this->data);
  }




  
}
