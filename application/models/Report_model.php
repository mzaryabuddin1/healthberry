<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Report_model
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

class Report_model extends CI_Model
{

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

  public function locations()
  {
    return $this->db->select("*")->from("locations")->get()->result_array();
  }
  public function get_doctors($params)
  {
    if (isset($params['city'])) {
      $this->db->where("city", $params['city']);
    }
    return $this->db->select("*")->from("locations")->get()->result_array();
  }

  public function get_calls_report($params)
  {
    return $this->db->select('location_calls.*, locations.doctor_name, DAYNAME(location_calls.created_at) AS dayname')
      ->from('location_calls')
      ->join('locations', 'locations.id = location_calls.location_id', 'left')
      ->where('location_calls.created_at BETWEEN \' ' . $params['datefrom'] . ' \' AND \' ' . $params['dateto'] . ' \'')
      ->where('location_calls.app_user_id', $params['app_user_id'])
      ->where("DAYNAME(location_calls.created_at)", $params['dayname'])
      ->get()->result_array();
  }

  public function get_doctor_calls_or_plans_via_city_and_id($params)
  {
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, locations.doctor_name as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')->from($params['calls-plan'])
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('cities', 'cities.id = locations.city', 'left')
    ->where('locations.city', $params['city_id'])
    ->where($params['calls-plan'].'.location_id', $params['location_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_user_calls_or_plans_via_city_and_id($params)
  {
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, app_users.username as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')->from($params['calls-plan'])
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('cities', 'cities.id = app_users.city', 'left')
    ->where('app_users.city', $params['city_id'])
    ->where($params['calls-plan'] . '.app_user_id', $params['app_user_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_doctor_calls_or_plans_via_city($params)
  {
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, locations.doctor_name as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')->from($params['calls-plan'])
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('cities', 'cities.id = locations.city', 'left')
    ->where('locations.city', $params['city_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_user_calls_or_plans_via_city($params)
  {
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, app_users.username as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')->from($params['calls-plan'])
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('cities', 'cities.id = app_users.city', 'left')
    ->where('app_users.city', $params['city_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_doctor_calls_or_plans_via_id($params)
  {
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, locations.doctor_name as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')->from($params['calls-plan'])
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('cities', 'cities.id = locations.city', 'left')
    ->where($params['calls-plan'].'.location_id', $params['location_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_user_calls_or_plans_via_id($params)
  {

    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, app_users.username as the_name, cities.city_name, locations.doctor_name, app_users.username as user_name')
    ->from($params['calls-plan'])
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('cities', 'cities.id = app_users.city', 'left')
    ->where($params['calls-plan'] . '.app_user_id', $params['app_user_id'])
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  public function get_calls_or_plans_via_city($params)
  {

    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, cities.city_name, locations.doctor_name, app_users.username as user_name')
    ->from($params['calls-plan'])
    ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
    ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
    ->join('cities', 'cities.id = locations.city', 'left')
    ->group_start()
        ->where('locations.city', $params['city_id']) // Condition for locations.city
        ->where('app_users.city', $params['city_id']) // Condition for app_users.city
    ->group_end()
    ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
    ->get()->result_array();
  }

  // get_calls_or_plans

  public function get_calls_or_plans($params)
  {
    // Initialize the base select statement
    return $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname, cities.city_name, locations.doctor_name, app_users.username as user_name')
      ->from($params['calls-plan'])
      ->join('locations', 'locations.id = '.$params['calls-plan'].'.location_id', 'left')
      ->join('app_users', 'app_users.id = '.$params['calls-plan'].'.app_user_id', 'left')
      ->join('cities', 'cities.id = locations.city', 'left')
      ->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'')
      ->get()->result_array();
  }


  // public function get_dynamic_reports($params)
  // {
  //   // Initialize the base select statement
  //   $this->db->select($params['calls-plan'] . '.*, DAYNAME(' . $params['calls-plan'] . '.created_at) as dayname')
  //     ->from($params['calls-plan']);

  //   // Handle date range condition
  //   if (isset($params['datefrom']) && isset($params['dateto'])) {
  //     $this->db->where($params['calls-plan'] . '.created_at BETWEEN \'' . $params['datefrom'] . '\' AND \'' . $params['dateto'] . '\'');
  //   }

  //   // Handle city condition
  //   if (isset($params['city_id']) && !empty($params['city_id'])) {

  //     // If doctor/user is specified
  //     if (isset($params['doctor-user']) && $params['doctor-user'] == 'doctor') {
  //       $this->db->join('locations', 'locations.id = ' . $params['calls-plan'] . '.x', 'left');
  //       $this->db->where('locations.city', $params['city_id']);
  //     } elseif (isset($params['doctor-user']) && $params['doctor-user'] == 'user') {
  //       $this->db->join('app_users', 'app_users.id = ' . $params['calls-plan'] . '.app_user_id', 'left');
  //       $this->db->where('app_users.city', $params['city_id']);
  //     } else {
  //       // If no specific doctor/user type is specified, check both
  //       $this->db->group_start()
  //         ->join('locations', 'locations.id = ' . $params['calls-plan'] . '.location_id', 'left')
  //         ->join('app_users', 'app_users.id = ' . $params['calls-plan'] . '.app_user_id', 'left')
  //         ->where('app_users.city', $params['city_id'])
  //         ->or_where('locations.city', $params['city_id'])
  //         ->group_end();
  //     }
  //     $this->db->join('cities', 'cities.id = app_users.city OR cities.id = locations.city', 'left');

  //   }

  //   // Handle user condition
  //   if (isset($params['app_user_id']) && !empty($params['app_user_id'])) {
  //     $this->db->where($params['calls-plan'] . '.app_user_id', $params['app_user_id']);
  //   }

  //   // Handle location condition
  //   if (isset($params['location_id']) && !empty($params['location_id'])) {
  //     $this->db->where($params['calls-plan'] . '.location_id', $params['location_id']);
  //   }

  //   // Execute final query and return results
  //   // $result = $this->db->get()->result_array();

  //   // Execute final query and return results
  //   return $this->db->get()->result_array();
  // }
}
