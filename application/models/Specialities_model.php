<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Specialities_model
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

class Specialities_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_locations()
  {
    return $this->db->select("*")->from('specialities')->get()->result_array();
  }

  // ------------------------------------------------------------------------

}

/* End of file Specialities_model.php */
/* Location: ./application/models/Specialities_model.php */