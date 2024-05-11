<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor extends CI_Controller
{

  private $data;
  private $__currentdatetime;
    
  public function __construct()
  {
    parent::__construct();
    $this->checksession->validatesession();
    if($_SESSION['user_roles'] != 'admin'){ header("Location: " . base_url() . 'login?error=Unauthorized Access'); }
    $this->load->model('Plan_model');
    date_default_timezone_set("Asia/Karachi");
    $this->__currentdatetime = date("Y-m-d H:i:s", time());
  }

  public function index()
  {
    $this->load->view('manage_doctor_view');
  }

  public function weekly_plan()
  {
    $this->data['cities'] = $this->Plan_model->cities();
    $this->data['app_users'] = $this->Plan_model->app_users();
    $this->load->view('weekly_plan', $this->data);
  }

  public function search_plan()
  {
    $information = $this->input->post();
    $result['locations'] = $this->Plan_model->locationsviacity($information['city']);
    $result['plans'] = $this->Plan_model->plansviauserid($information['user']);

    echo json_encode($result);
    exit;
  }

  public function create_plan_submit()
  {
    $this->form_validation->set_rules('location_id', 'Location', 'required|numeric');
		$this->form_validation->set_rules('app_user_id', 'User', 'required|numeric');
		$this->form_validation->set_rules('planned_day', 'Day', 'required|in_list[Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday]');
		$this->form_validation->set_rules('planned_time', 'Time', 'required');

		if ($this->form_validation->run() == false) {
			$errors = array('error' => validation_errors());
			print_r(json_encode($errors));
			exit;
		}

		$information = $this->security->xss_clean($this->input->post());

    $this->data['location_id'] = $information['location_id'];
    $this->data['app_user_id'] = $information['app_user_id'];
    $this->data['planned_day'] = $information['planned_day'];
    $this->data['planned_time'] = $information['planned_time'];
    $this->data['created_by'] = $_SESSION['user_id'];

    $result = $this->Plan_model->create_plan($this->data);

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

  public function edit_plan_submit()
  {
		$this->form_validation->set_rules('planid', 'User', 'required|numeric');
		$this->form_validation->set_rules('planned_day', 'Day', 'required|in_list[Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday]');
		$this->form_validation->set_rules('planned_time', 'Time', 'required');

		if ($this->form_validation->run() == false) {
			$errors = array('error' => validation_errors());
			print_r(json_encode($errors));
			exit;
		}

		$information = $this->security->xss_clean($this->input->post());

    $this->data['id'] = $information['planid'];
    $this->data['planned_day'] = $information['planned_day'];
    $this->data['planned_time'] = $information['planned_time'];
    $this->data['updated_by'] = $_SESSION['user_id'];
    $this->data['updated_at'] = $this->__currentdatetime;

    $result = $this->Plan_model->update_plan($this->data);

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

  public function remove_plan_submit()
  {
    $this->form_validation->set_rules('id', 'ID', 'required|numeric');

		if ($this->form_validation->run() == false) {
			$errors = array('error' => validation_errors());
			print_r(json_encode($errors));
			exit;
		}

		$information = $this->security->xss_clean($this->input->post());

    $result = $this->Plan_model->remove_plan($information['id']);

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
