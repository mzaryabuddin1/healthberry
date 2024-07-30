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
        $this->allowed_extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'docx', 'pdf', 'webp');
        $this->load->model('Users_model');
        $this->__currentdatetime = date("Y-m-d H:i:s", time());
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

    public function add_app_user()
    {
        $this->load->view('add_app_user_view');
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

    public function app_user_submit()
    {

        $this->load->library('upload');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[100]|is_unique[app_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[100]');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $response['message'] = validation_errors();
            $response['status'] = "0";
        } else {
            // Validation passed
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $created_at = date('Y-m-d H:i:s'); // Current timestamp
            $file_url = null;

            if ($_FILES["file_name"]["tmp_name"]) {
                //VALIDATE EXTENSION
                $ext = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);
                if (!in_array($ext, $this->allowed_extensions)) {
                    $errors = array('error' => '<p>Incorrect file format!</p>');
                    print_r(json_encode($errors));
                    exit;
                }
                //VALIDATE FILE SIZE
                $filesize = $_FILES["file_name"]["size"];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $errors = array('error' => '<p>File is too large to upload!</p>');
                    print_r(json_encode($errors));
                    exit;
                }
                $temp = explode(".", $_FILES["file_name"]["name"]);
                $newfilename = round(microtime(true)) .  rand(111111, 999999) . '.' . end($temp);
                $uploaddir = 'uploads/' . $newfilename;
                if (!move_uploaded_file($_FILES['file_name']['tmp_name'], $uploaddir)) {
                    $errors = array('error' => '<p>Error while uploading Size Chart!</p>');
                    print_r(json_encode($errors));
                    exit;
                } else {
                    $file_url = base_url().'uploads/'.$newfilename;
                }
            }

            // Call model method to save the data
            $result = $this->Users_model->save_data_app_user($username, $password, $created_at, $file_url);

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

    public function edit_app_user_submit()
    {

        $this->load->library('upload');

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('city', 'City', 'trim|numeric|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            print_r(validation_errors());
            $response['message'] = validation_errors();
            $response['status'] = "0";
        } else {
            // Validation passed

            $update['id'] = $this->input->post('id');
            if($this->input->post('password')){
                $update['password'] = md5($this->input->post('password'));
            }
            $update['updated_at'] = $this->__currentdatetime;
            $update['updated_by'] = $_SESSION['user_id'];
            $update['status'] = $this->input->post('status');
            $update['city'] = $this->input->post('city');

            if ($_FILES["file_name"]["tmp_name"]) {
                //VALIDATE EXTENSION
                $ext = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);
                if (!in_array($ext, $this->allowed_extensions)) {
                    $errors = array('error' => '<p>Incorrect file format!</p>');
                    print_r(json_encode($errors));
                    exit;
                }
                //VALIDATE FILE SIZE
                $filesize = $_FILES["file_name"]["size"];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $errors = array('error' => '<p>File is too large to upload!</p>');
                    print_r(json_encode($errors));
                    exit;
                }
                $temp = explode(".", $_FILES["file_name"]["name"]);
                $newfilename = round(microtime(true)) .  rand(111111, 999999) . '.' . end($temp);
                $uploaddir = 'uploads/' . $newfilename;
                if (!move_uploaded_file($_FILES['file_name']['tmp_name'], $uploaddir)) {
                    $errors = array('error' => '<p>Error while uploading Size Chart!</p>');
                    print_r(json_encode($errors));
                    exit;
                } else {
                    $update['profile_picture'] = base_url().'uploads/'.$newfilename;
                }
            }

            // Call model method to save the data
            $result = $this->Users_model->update_data_app_user($update);

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
            $password = $this->input->post('password') ? md5($this->input->post('password')) : NULL;
            $status = $this->input->post('status');
            $roles = $this->input->post('roles');
            $id = $this->input->post('id');

            // print_r($this->input->post('password'));
            // exit;

            // Call model method to save the data
            $result = $this->Users_model->update_data($name, $email, $password, $roles, $status, $id);

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

    public function edit_app_user($id)
    {
        $data['data'] = $this->Users_model->get_app_user_row($id);
        if (empty($data['data'])) {
            header("Location: " . base_url() . 'manage-app-users');
            exit;
        }
        $data['cities'] = $this->Users_model->get_cities();
        $this->load->view('edit_app_user_view', $data);
    }
}
