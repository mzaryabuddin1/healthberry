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
        $this->load->model('Users_model');
    }

    public function index()
    {
        $data['data'] = $this->Users_model->get_users();
        $this->load->view('manage_users_view', $data);
    }
    public function app_users()
    {
        $data['data'] = $this->Users_model->get_app_users();
        $this->load->view('manage_app_users_view', $data);
    }
    
    public function add()
    {
        $this->load->view('add_user_view');
    }
    public function user_submit()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'email', 'required|trim|max_length[100]|is_unique[users.name]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[100]');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $response['message'] = validation_errors();
            $response['status'] = "0";
        } else {
            // Validation passed
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $status = $this->input->post('status');
            $roles = $this->input->post('roles');
            $created_at = date('Y-m-d H:i:s'); // Current timestamp

            // Call model method to save the data
            $result = $this->Users_model->save_data($name, $email, $password, $roles, $created_at, $status);

            if ($result) {
                $response['status'] = "1";
                $response['message'] = "Form submitted successfully!";
            } else {
                $response['status'] = "0";
                $response['message'] = "Failed to submit form!";
            }
        }
        echo json_encode($response);
    }
    public function user_update()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('id', 'id', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'email', 'required|trim|max_length[100]|is_unique[users.name]');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $response['message'] = validation_errors();
            $response['status'] = "0";
        } else {
            // Validation passed
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $status = $this->input->post('status');
            $roles = $this->input->post('roles');
            $id = $this->input->post('id');

            // Call model method to save the data
            $result = $this->Users_model->update_data($name, $email, $password, $roles, $status,$id);

            if ($result) {
                $response['status'] = "1";
                $response['message'] = "Form submitted successfully!";
            } else {
                $response['status'] = "0";
                $response['message'] = "Failed to submit form!";
            }
        }
        echo json_encode($response);
    }

    public function edit_user($id)
    {
        $data['data'] = $this->Users_model->get_user_row($id);
        if (empty($data['data'])) {
            header("Location: " . base_url() . 'manage-users');
            exit;
        }
        $this->load->view('edit_users_view', $data);
    }
}
