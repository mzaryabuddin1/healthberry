<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends CI_Controller
{
  
  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Dashboard_model');

  }

  public function index()
  {
    $this->checksession->validatesession();
    $this->data['doctors'] = $this->Dashboard_model->get_doctors();
    $this->data['products'] = $this->Dashboard_model->get_products();
    $this->data['feild_users'] = $this->Dashboard_model->get_feild_users();
    $this->data['admin_users'] = $this->Dashboard_model->get_admin_users();
    $this->data['calls_of_doctors'] = $this->Dashboard_model->calls_of_doctors();
    $this->data['locations'] = $this->Dashboard_model->get_locations();
    $this->data['leader'] = $this->Dashboard_model->get_leaders();
    $this->data['city_wise'] = $this->Dashboard_model->get_city_wise_locations();
    // print_r($this->data['calls_of_doctors']);
    // exit;

    $_SESSION['user_roles'] == 'admin' ? $this->load->view('dashboard_view', $this->data) : $this->load->view('user_dashboard_view', $this->data);
  }

}


