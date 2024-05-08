<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Report extends CI_Controller
{

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->checksession->validatesession();
    if ($_SESSION['user_roles'] != 'admin') {
      header("Location: " . base_url() . 'login?error=Unauthorized Access');
    }
    $this->load->model('Report_model');
    $this->__currentdatetime = date("Y-m-d H:i:s", time());
  }

  public function doctors()
  {
    $this->data['cities'] = $this->Report_model->cities();
    $this->data['app_users'] = $this->Report_model->app_users();
    $this->load->view('report_doctor_view', $this->data);
  }

  public function get_doctors()
  {
    $information = $this->input->post();
    $result = $this->Report_model->get_doctors($information);
    echo json_encode($result);
  }

}


/* End of file Report.php */
/* Location: ./application/controllers/Report.php */