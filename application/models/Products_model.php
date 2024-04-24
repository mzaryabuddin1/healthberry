<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Products_model
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

class Products_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_products()
  {
    return $this->db->select("*")->from('products')->get()->result_array();
  }
  public function get_active_products()
  {
    return $this->db->select("*")->from('products')->where("status", '1')->get()->result_array();
  }
  public function get_active_cities()
  {
    return $this->db->select("*")->from('cities')->get()->result_array();
  }
  
  

  public function save_data($name, $generic, $form, $maxpercentage, $created_at)
  {
    $data = array(
      'name' => $name,
      'generic' => $generic,
      'form' => $form,
      'maxpercentage' => $maxpercentage,
      'created_at' => $created_at
    );

    return $this->db->insert('products', $data);
  }
  public function update_data($id, $name, $generic, $form, $maxpercentage,$status)
  {
    $data = array(
      'name' => $name,
      'generic' => $generic,
      'form' => $form,
      'status' => $status,
      'maxpercentage' => $maxpercentage
    );

    $this->db->where('id', $id);
    return $this->db->update('products', $data);
  }
  public function get_product_row($id)
  {
    return $this->db->select("*")->from('products')->where("id", $id)->get()->row_array();
  }




  // ------------------------------------------------------------------------

}

/* End of file Products_model.php */
/* Location: ./application/models/Products_model.php */