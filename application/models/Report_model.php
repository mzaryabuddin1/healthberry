<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class Report_model extends CI_Model {

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

  // ------------------------------------------------------------------------

}

/* End of file Report_model.php */
/* Location: ./application/models/Report_model.php */