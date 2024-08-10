<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

class Locations_model extends CI_Model
{

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
    // return $this->db->select('locations.*, cities.city_name')
    //      ->from('locations')
    //      ->join('cities', 'cities.id = locations.city')
    //      ->get()
    //      ->result_array();
    $sql = "
          SELECT locations.*, cities.city_name, GROUP_CONCAT(products.name) AS product_names FROM locations JOIN cities ON cities.id = locations.city LEFT JOIN products ON FIND_IN_SET(products.id, REPLACE(REPLACE(REPLACE(locations.products, '[', ''), ']', ''), '\"', '')) GROUP BY locations.id;
      ";

    return $this->db->query($sql)->result_array();
  }
  public function get_locations_via_id($id)
  {
    $sql = "
      SELECT locations.*, cities.city_name, GROUP_CONCAT(products.name) AS product_names FROM locations JOIN cities ON cities.id = locations.city LEFT JOIN products ON FIND_IN_SET(products.id, REPLACE(REPLACE(REPLACE(locations.products, '[', ''), ']', ''), '\"', '')) WHERE locations.id = $id GROUP BY locations.id;
    ";

    return $this->db->query($sql)->row_array();
  }
  public function insert_location($data)
  {
    // Insert data into 'locations' table
    return $this->db->insert('locations', $data);
  }

  public function update_location($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('locations', $data);
  }
  // ------------------------------------------------------------------------

}

/* End of file Locations_model.php */
/* Location: ./application/models/Locations_model.php */