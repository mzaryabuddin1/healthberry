<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Appuser_model
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

class Appuser_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  public function login_submit($params)
  {
      return ($this->db->select('*')
      ->from('app_users')
      ->where('app_users.username', $params['username'])
      ->where('app_users.password', $params['password'])
      ->get()
      ->result_array());
  }

  public function get_plan($params)
  {
      return ($this->db->select('
      weekly_plan.*,
      locations.doctor_name,
      locations.area,
      locations.city,
      locations.chemists,
      locations.specialities,
      locations.timings,
      locations.latitude,
      locations.longitude,
      ',
      )
      ->from('weekly_plan')
      ->where('weekly_plan.app_user_id', $params)
      ->where('locations.status', 1)
      ->join('app_users', 'app_users.id = weekly_plan.app_user_id', 'left')
      ->join('locations', 'locations.id = weekly_plan.location_id', 'left')
      ->get()
      ->result_array());
  }

  public function get_doctor_location_by_plan_id($params)
  {
      return ($this->db->select('
      weekly_plan.*,
      locations.doctor_name,
      locations.area,
      locations.city,
      locations.chemists,
      locations.specialities,
      locations.timings,
      locations.latitude,
      locations.longitude,
      ',
      )
      ->from('weekly_plan')
      ->where('weekly_plan.app_user_id', $params['app_user_id'])
      ->where('weekly_plan.id', $params['plan_id'])
      ->where('locations.status', 1)
      ->join('app_users', 'app_users.id = weekly_plan.app_user_id', 'left')
      ->join('locations', 'locations.id = weekly_plan.location_id', 'left')
      ->get()
      ->result_array());
  }

  // ------------------------------------------------------------------------

}

/* End of file Appuser_model.php */
/* Location: ./application/models/Appuser_model.php */