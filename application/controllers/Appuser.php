<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Appuser extends CI_Controller
{
  private $data;
  private $__currentdatetime;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Appuser_model');
    date_default_timezone_set("Asia/Karachi");
    $this->__currentdatetime = date("Y-m-d H:i:s", time());
  }

  public function index()
  {
    $this->load->view("app_login_view");
  }

  public function checksession()
  {
    if (!isset($_SESSION['app_user_id']) || empty($_SESSION['app_user_id'])) {
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
    $this->data['cities'] = $this->Appuser_model->get_cities();
    $this->data['products'] = $this->Appuser_model->get_active_products();
    // $this->data['history'] = $this->Appuser_model->get_history($_SESSION['app_user_id']);
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

  public function get_my_history()
  {
    $this->checksession();
    $this->data['history'] = $this->Appuser_model->get_history($_SESSION['app_user_id']);
    echo json_encode($this->data['history']);
  }

  public function check_current_location($dbLat, $dbLng, $phpLat, $phpLng, $radius)
  {
    // Earth radius in meters
    $earthRadius = 6371000;

    // Convert latitude and longitude from degrees to radians
    $dbLatRad = deg2rad($dbLat);
    $dbLngRad = deg2rad($dbLng);
    $phpLatRad = deg2rad($phpLat);
    $phpLngRad = deg2rad($phpLng);

    // Calculate the distance between two points using Haversine formula
    $deltaLat = $phpLatRad - $dbLatRad;
    $deltaLng = $phpLngRad - $dbLngRad;
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($dbLatRad) * cos($phpLatRad) * sin($deltaLng / 2) * sin($deltaLng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;

    // Check if the distance is within the radius
    if ($distance <= $radius) {
      return true;
    } else {
      return false;
    }
  }

  public function call_submit()
  {
    $this->checksession();

    $this->form_validation->set_rules('plan_id', 'Plan ID', 'required|integer');
    $this->form_validation->set_rules('latitude', 'Latitude', 'required|numeric|greater_than_equal_to[-90]|less_than_equal_to[90]');
    $this->form_validation->set_rules('longitude', 'Longitude', 'required|numeric|greater_than_equal_to[-180]|less_than_equal_to[180]');
    $this->form_validation->set_rules('imageData', 'Image', 'required');

    if ($this->form_validation->run() == false) {
      $errors = array('error' => validation_errors());
      print_r(json_encode($errors));
      exit;
    }

    $information = $this->security->xss_clean($this->input->post());

    // GET PLAN ID CHECK RADIUS
    $location_lat_lng = $this->Appuser_model->get_location_info_by_id($information['location_id']);
    if (!$location_lat_lng) {
      $errors = array('error' => 'Location is not available');
      print_r(json_encode($errors));
      exit;
    }



    $is_within_radius = $this->check_current_location(
      $location_lat_lng['latitude'],
      $location_lat_lng['longitude'],
      $information['latitude'],
      $information['longitude'],
      100 // Adjust the radius as needed
    );

    if(!$is_within_radius){
      $errors = array('error' => 'You are not in area please close to it.');
      print_r(json_encode($errors));
      exit;
    }

    // Decode base64-encoded image data
    $imageData = $this->input->post("imageData");
    $decodedImageData = base64_decode(str_replace('data:image/jpeg;base64,', '', $imageData));
    if (empty($imageData) || $imageData == 'data:,') {
      $errors = array('error' => 'No image  received');
      print_r(json_encode($errors));
      exit;
    }
    // Generate a unique filename
    $filename = uniqid() . '.jpg';
    // Specify the path to save the image
    $pathToSave = FCPATH . 'uploads/' . $filename;
    // Save the image to file
    file_put_contents($pathToSave, $decodedImageData);

    $this->data['app_user_id'] = $_SESSION['app_user_id'];
    $this->data['location_id'] = $information['location_id'];
    $this->data['plan_id'] = $information['plan_id'] ? $information['plan_id'] : null;
    $this->data['latitude'] = $information['latitude'];
    $this->data['longitude'] = $information['longitude'];
    $this->data['evidance_picture'] = base_url() . "uploads/" . $filename;
    $this->data['created_at'] = $this->__currentdatetime;

    $result = $this->Appuser_model->save_call($this->data);

    if ($result) {
      $success = array('success' => 1);
      print_r(json_encode($success));
      exit;
    } else {
      $errors = array('error' => 'Unable to save');
      print_r(json_encode($errors));
      exit;
    }
  }

  public function new_location_submit()
  {
    $this->checksession();

    $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required|trim');
    $this->form_validation->set_rules('products[]', 'Products', 'required|trim');
    $this->form_validation->set_rules('latitude', 'Latitude', 'required|numeric|greater_than_equal_to[-90]|less_than_equal_to[90]');
    $this->form_validation->set_rules('longitude', 'Longitude', 'required|numeric|greater_than_equal_to[-180]|less_than_equal_to[180]');
    $this->form_validation->set_rules('city', 'City', 'required|numeric');
    $this->form_validation->set_rules('chemists[]', 'Chemists', 'required|trim');
    $this->form_validation->set_rules('specialities[]', 'Specialities', 'required|trim');
    $this->form_validation->set_rules('days[]', 'Days', 'required|trim');
    $this->form_validation->set_rules('timings_from[]', 'Timing From', 'required|trim');
    $this->form_validation->set_rules('timings_to[]', 'Timing To', 'required|trim');

    if ($this->form_validation->run() == false) {
      $errors = array('error' => validation_errors());
      print_r(json_encode($errors));
      exit;
    }

    $information = $this->security->xss_clean($this->input->post());
    $this->data['created_user'] = "appuser";
    $this->data['created_by'] = $_SESSION['app_user_id'];
    $this->data['doctor_name'] = $information['doctor_name'];
    $this->data['products'] = json_encode($information['products']);
    $this->data['latitude'] = $information['latitude'];
    $this->data['longitude'] = $information['longitude'];
    $this->data['city'] = $information['city'];
    $this->data['chemists'] = json_encode($information['chemists']);
    $this->data['specialities'] = json_encode($information['specialities']);

    $timings_arr = [];
    $i = 0;
    foreach ($information['days'] as $row) {
      $obj = new stdClass;
      $obj->dayname = $row;
      $obj->from = $information['timings_from'][$i];
      $obj->to = $information['timings_to'][$i];
      array_push($timings_arr, $obj);
      $i++;
    }
    $this->data['timings'] = json_encode($timings_arr);
    $this->data['is_approved'] = 0;
    $this->data['created_at'] = $this->__currentdatetime;

    $result = $this->Appuser_model->save_location($this->data);

    if ($result) {
      $success = array('success' => 1);
      print_r(json_encode($success));
      exit;
    } else {
      $errors = array('error' => 'Unable to save');
      print_r(json_encode($errors));
      exit;
    }
  }
}
