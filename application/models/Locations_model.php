<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Locations_model
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

class Locations_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_locations()
  {
    // return $this->db->select("*")->from('locations')->get()->result_array();
    return $this->db->select('locations.*, cities.city_name')
         ->from('locations')
         ->join('cities', 'cities.id = locations.city')
         ->get()
         ->result_array();
  }
  public function insert_location($data) {
    // Insert data into 'locations' table
    return $this->db->insert('locations', $data);
}
  // ------------------------------------------------------------------------

}

/* End of file Locations_model.php */
/* Location: ./application/models/Locations_model.php */