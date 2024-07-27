<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Products
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checksession->validatesession();
        if ($_SESSION['user_roles'] != 'admin') {
            header("Location: " . base_url() . 'login?error=Unauthorized Access');
        }
        $this->load->model('Products_model');
    }

    public function index()
    {
        $data['data'] = $this->Products_model->get_products();
        $this->load->view('manage_products_view', $data);
    }
    public function gallery()
    {
        $data['data'] = $this->Products_model->get_products();
        $this->load->view('manage_products_gallery_view', $data);
    }
    public function add()
    {
        $this->load->view('add_products_view');
    }
    public function edit_product($id)
    {
        $data['data'] = $this->Products_model->get_product_row($id);
        if(empty($data['data'])){
            header("Location: " . base_url() . 'manage-products');
            exit;
        }
        $this->load->view('edit_products_view',$data);
    }
    
    public function product_submit()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]|is_unique[products.name]');
        $this->form_validation->set_rules('generic', 'Generic', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('form', 'Form', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('maxpercentage', 'Max Percentage', 'required|trim|max_length[100]');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $response['message'] = validation_errors();
            $response['status'] = "0";
        } else {
            // Validation passed
            $name = $this->input->post('name');
            $generic = $this->input->post('generic');
            $form = $this->input->post('form');
            $maxpercentage = $this->input->post('maxpercentage');
            $created_at = date('Y-m-d H:i:s'); // Current timestamp
            $picture = "https://png.pngtree.com/template/20190422/ourmid/pngtree-cross-plus-medical-logo-icon-design-template-image_145195.jpg";

            if(!empty($_FILES['file']['name'])){
                // Set upload preferences
                $this->load->library('upload');
                $config['upload_path'] = 'uploads'; // Path to upload the file
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
                $config['max_size'] = '2048'; // Maximum file size (2MB)
                $config['file_name'] = time() . '_' . $_FILES['file']['name']; // Rename the file to avoid conflicts
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('file')) {
                    // File upload successful
                    $upload_data = $this->upload->data();
                    $picture = base_url() . 'uploads/' . $upload_data['file_name'];
                }
            }


            // Call model method to save the data
            $result = $this->Products_model->save_data($name, $generic, $form, $maxpercentage, $created_at, $picture);

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

    
    public function product_update() {

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('generic', 'Generic', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('form', 'Form', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('id', 'ID', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('maxpercentage', 'Max Percentage', 'required|trim|max_length[100]');

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $response['message'] = validation_errors();
            $response['status'] = '0';
        } else {
            // Validation passed
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $generic = $this->input->post('generic');
            $form = $this->input->post('form');
            $maxpercentage = $this->input->post('maxpercentage');
            $status = $this->input->post('status');
            $picture = NULL;

            if(!empty($_FILES['file']['name'])){
                // Set upload preferences
                $this->load->library('upload');
                $config['upload_path'] = 'uploads'; // Path to upload the file
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
                $config['max_size'] = '2048'; // Maximum file size (2MB)
                $config['file_name'] = time() . '_' . $_FILES['file']['name']; // Rename the file to avoid conflicts
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('file')) {
                    // File upload successful
                    $upload_data = $this->upload->data();
                    $picture = base_url() . 'uploads/' . $upload_data['file_name'];
                }
            }

            // Call model method to update the data
            $result = $this->Products_model->update_data($id, $name, $generic, $form, $maxpercentage,$status, $picture);

            if($result) {
                $response['message'] = "Form updated successfully!";
                $response['status'] = '1';
            } else {
                $response['message'] = "Failed to update form!";
                $response['status'] = '0';
            }
        }

        echo json_encode($response);
    }
}


/* End of file Products.php */
/* Location: ./application/controllers/Products.php */