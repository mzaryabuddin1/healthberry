<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Dashboard_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Dashboard_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_doctors()
  {
    return $this->db->select('locations.*, cities.city_name')
    ->from('locations')
    ->join('cities', 'cities.id = locations.city')
    ->get()
    ->result_array();
  }
  public function get_products()
  {
    return $this->db->select('products.*')
    ->from('products')
    ->get()
    ->result_array();
  }
  public function get_feild_users()
  {
    return $this->db->select('app_users.*')
    ->from('app_users')
    ->get()
    ->result_array();
  }
  public function get_admin_users()
  {
    return $this->db->select('users.*')
    ->from('users')
    ->get()
    ->result_array();
  }
  public function calls_of_doctors()
  {
    return $this->db->select('COUNT(location_calls.id) as call_count, locations.doctor_name')
                    ->from('location_calls')
                    ->join('locations', 'locations.id = location_calls.location_id', 'left')
                    ->join('cities', 'cities.id = locations.city', 'left')
                    ->join('app_users', 'app_users.id = location_calls.app_user_id', 'left')
                    ->group_by('locations.doctor_name')
                    ->order_by('call_count', 'desc')
                    ->limit(10)
                    ->get()
                    ->result_array();
  }
  public function get_locations()
  {
    return $this->db->select('*')
    ->from('locations')
    ->limit(100)
    ->order_by('RAND()')
    ->get()
    ->result_array();
  }
  public function get_leaders()
  {
    return $this->db->select('COUNT(location_calls.id) as call_count, app_users.username')
                    ->from('location_calls')
                    ->join('locations', 'locations.id = location_calls.location_id', 'left')
                    ->join('cities', 'cities.id = locations.city', 'left')
                    ->join('app_users', 'app_users.id = location_calls.app_user_id', 'left')
                    ->group_by('app_users.username')
                    ->order_by('call_count', 'desc')
                    ->limit(10)
                    ->get()
                    ->result_array();
  }

  public function get_city_wise_locations()
  {
    return $this->db->select('COUNT(locations.id) as loc_count, cities.city_name')
    ->from('locations')
    ->join('cities', 'cities.id = locations.city', 'left')
    ->group_by('cities.city_name')
    ->order_by('loc_count', 'desc')
    ->limit(10)
    ->get()
    ->result_array();
  }

  // ------------------------------------------------------------------------

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */