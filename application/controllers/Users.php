<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->checksession->validatesession();
        if ($_SESSION['user_roles'] != 'admin') {
            header("Location: " . base_url() . 'login?error=Unauthorized Access');
        }
    }

    public function index()
    {
        $this->load->model('Users_model');
        $data['data'] = $this->Users_model->get_users();
        $this->load->view('manage_users_view', $data);
    }
}
