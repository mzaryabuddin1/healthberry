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

  // ------------------------------------------------------------------------

}

/* End of file Appuser_model.php */
/* Location: ./application/models/Appuser_model.php */