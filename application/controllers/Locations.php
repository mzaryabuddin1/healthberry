<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Locations
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

class Locations extends CI_Controller
{
    
  public function __construct()
    {
        parent::__construct();
        $this->checksession->validatesession();
        if ($_SESSION['user_roles'] != 'admin') {
            header("Location: " . base_url() . 'login?error=Unauthorized Access');
        }
        $this->load->model('Locations_model');

    }
    
    public function view_doctor_details($id) {
        $data['data'] = $this->Locations_model->get_locations_via_id($id);
        $this->load->view('location_detail_view', $data);
    }

    public function index()
    {
        $data['data'] = $this->Locations_model->get_locations();
        $this->load->view('manage_locations_view', $data);
    }
    public function add()
    {
        $this->load->model('Products_model');

        $data['products'] = $this->Products_model->get_active_products();
        $data['cities'] = $this->Products_model->get_active_cities();
        $data['data'] = $this->Locations_model->get_locations();
        $this->load->view('add_locations_view', $data);
    }

    function location_submit(){
       // Form validation rules
       $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'trim|required');
       $this->form_validation->set_rules('products[]', 'Products', 'trim|required');
       $this->form_validation->set_rules('area', 'Area', 'trim|required');
       $this->form_validation->set_rules('city', 'City', 'trim|required');
       $this->form_validation->set_rules('chemists', 'Chemists', 'trim|required');
       $this->form_validation->set_rules('specialities', 'Specialities', 'trim|required');
       $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
       $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');

       if ($this->form_validation->run() === FALSE) {
           // Form validation failed, return validation errors
           $errors = validation_errors();
           $response = [
               'status' => 0,
               'errors' => $errors
           ];
       } else {
        $timings_arr = [];
        $i = 0;
        foreach ($_POST['days'] as $row) {
          $obj = new stdClass;
          $obj->dayname = $row;
          $obj->from = $_POST['timings_from'][$i];
          $obj->to = $_POST['timings_to'][$i];
          array_push($timings_arr, $obj);
          $i++;
        }
       
           // Form validation passed, insert data into database
           $data = [
               'doctor_name' => $this->input->post('doctor_name'),
               'products' => json_encode($this->input->post('products')),
               'area' => $this->input->post('area'),
               'city' => $this->input->post('city'),
               'chemists' =>  $this->input->post('chemists'),
               'specialities' =>  $this->input->post('specialities'),
               'latitude' => $this->input->post('latitude'),
               'is_approved' => '0',
               'created_at' => date('Y-m-d H:i:s'),
               'created_user' => $_SESSION['user_roles'],
               'created_by' => $_SESSION['user_id'],
               
               'longitude' => $this->input->post('longitude')
           ];
              $data['timings'] = json_encode($timings_arr);

           if($_SESSION['user_roles']=='admin'){
            $data['is_approved']=1;
           }
           // Insert data into the database using the model
           $inserted = $this->Locations_model->insert_location($data);

           if ($inserted) {
               // Data inserted successfully
               $response = [
                   'status' => 1,
                   'message' => 'Location added successfully.'
               ];
           } else {
               // Failed to insert data
               $response = [
                   'status' => 0,
                   'message' => 'Failed to add location.'
               ];
           }
       }

       // Output JSON response
       $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    

}


/* End of file Locations.php */
/* Location: ./application/controllers/Locations.php */