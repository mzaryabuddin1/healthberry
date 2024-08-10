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

  public function calls()
  {
    $this->data['app_users'] = $this->Report_model->app_users();
    $this->load->view('report_calls_view', $this->data);
  }

  public function get_calls_report()
  {
    $this->form_validation->set_rules('datefrom', 'Date From', 'required|date');
		$this->form_validation->set_rules('dateto', 'Date To', 'required|date');
		$this->form_validation->set_rules('app_user_id', 'User', 'required|numeric');
		$this->form_validation->set_rules('dayname', 'Day', 'required|in_list[Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday]');

		if ($this->form_validation->run() == false) {
			$errors = array('error' => validation_errors());
			print_r(json_encode($errors));
			exit;
		}

    $information = $this->input->post();

    if($information['datefrom'] > $information['dateto'])
    {
      $errors = array('error' => '<p>Date From must be less than Date To.</p>');
      print_r(json_encode($errors));
      exit;
    }

    $result = $this->Report_model->get_calls_report($information);
    echo json_encode($result);
  }

  public function dynamic_report()
  {
    $this->data['app_users'] = $this->Report_model->app_users();
    $this->data['locations'] = $this->Report_model->locations();
    $this->data['cities'] = $this->Report_model->cities();
    $this->load->view('dynamic_reports_view', $this->data);
  }

  public function get_dynamic_reports()
  {
    $this->form_validation->set_rules('datefrom', 'Date From', 'required|date');
		$this->form_validation->set_rules('dateto', 'Date To', 'required|date');
    $this->form_validation->set_rules('calls-plan', 'Calls/Plan', 'required|in_list[location_calls,weekly_plan]');

    if(!empty($_POST['doctor-user'])){
      if($this->input->post('doctor-user') == 'doctor'){
        $this->form_validation->set_rules('location_id', 'Doctor', 'numeric');
      }else {
        $this->form_validation->set_rules('app_user_id', 'User', 'numeric');
      }
    }

		if ($this->form_validation->run() == false) {
			$errors = array('error' => validation_errors());
			print_r(json_encode($errors));
			exit;
		}

    if($this->input->post('dateto') <= $this->input->post('datefrom'))
    {
      $errors = array('error' => '<p>Date To must be greater than Date From.</p>');
      print_r(json_encode($errors));
      exit;
    }


    $information = $this->input->post();

    $result = [];
    if(!empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "doctor" && !empty($information['location_id'])){
      $result = $this->Report_model->get_doctor_calls_or_plans_via_city_and_id($information);
    }
    else if(!empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "user" && !empty($information['app_user_id'])){
      $result = $this->Report_model->get_user_calls_or_plans_via_city_and_id($information);
    }
    else if(empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "doctor" && !empty($information['location_id'])){
      $result = $this->Report_model->get_doctor_calls_or_plans_via_id($information);
    }
    else if(empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "user" && !empty($information['app_user_id'])){
      $result = $this->Report_model->get_user_calls_or_plans_via_id($information);
    }
    else if(!empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "doctor"){
      $result = $this->Report_model->get_doctor_calls_or_plans_via_city($information);
    }
    else if(!empty($information['city_id']) && !empty($information['doctor-user']) && $information['doctor-user'] == "user"){
      $result = $this->Report_model->get_user_calls_or_plans_via_city($information);
    }
    else if(!empty($information['city_id']) && empty($information['doctor-user'])){
      $result = $this->Report_model->get_calls_or_plans_via_city($information);
    }
    else if(empty($information['city_id']) && empty($information['doctor-user'])){
      $result = $this->Report_model->get_calls_or_plans($information);
    }

    



    // $result = $this->Report_model->get_dynamic_reports($information);

    echo json_encode($result);

  }
  public function show_create_table() {
      $table_name = 'weekly_plan';

      // Get column names using database metadata
      $columns = $this->db->list_fields($table_name);

      // Display or process column names
      if ($columns) {
          foreach ($columns as $column) {
              echo $column . "<br>";
          }
      } else {
          echo "No columns found for table '$table_name'.";
      }
  }

}


/* End of file Report.php */
/* Location: ./application/controllers/Report.php */