<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Plan_model
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

class Plan_model extends CI_Model {

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
  public function cities()
  {
    return $this->db->select("*")->from("cities")->get()->result_array();
  }
  public function app_users()
  {
    return $this->db->select("*")->from("app_users")->get()->result_array();
  }
  public function get_doctors($params)
  {
    if(isset($params['city'])){
      $this->db->where("city", $params['city']);
    }
    return $this->db->select("*")->from("locations")->get()->result_array();
  }

  public function locationsviacity($params)
  {
    return $this->db->select("locations.*, cities.city_name")
    ->from("locations")
    ->join("cities","cities.id = locations.city","left")
    ->where('city', $params)
    ->where('locations.status', 1)
    ->get()->result_array();
  }
  public function plansviauserid($params)
  {
    return $this->db->select("locations.*, app_users.username, weekly_plan.planned_day, weekly_plan.planned_time, weekly_plan.id as plan_id")->from("weekly_plan")
    ->join("locations","locations.id = weekly_plan.location_id","left")
    ->join("app_users","app_users.id = weekly_plan.app_user_id","left")
    ->where("weekly_plan.status", 1)
    ->where('app_user_id', $params)->get()->result_array();
  }

  public function create_plan($params)
  {
    return $this->db->insert('weekly_plan', $params);
  }

  public function update_plan($params)
  {
    $this->db->where('id', $params['id']);
    unset($params['id']);
    return $this->db->update('weekly_plan', $params);
  }

  public function remove_plan($params)
  {
    return $this->db->update('weekly_plan', ['status' => 0], ['id' => $params]);
  }

  // ------------------------------------------------------------------------

}

/* End of file Plan_model.php */
/* Location: ./application/models/Plan_model.php */