<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Users_model
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

class Users_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get_users()
  {
    return $this->db->select("*")->from('users')->get()->result_array();
  }

  // ------------------------------------------------------------------------

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */