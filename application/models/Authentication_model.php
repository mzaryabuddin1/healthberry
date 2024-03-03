<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Authentication_model
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

class Authentication_model extends CI_Model
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

  public function login_submit($params)
  {
    return $this->db->select("*")->from('users')->where('email', $params['email'])->where('password', $params['password'])->get()->row_array();
  }


  // ------------------------------------------------------------------------

}

/* End of file Authentication_model.php */
/* Location: ./application/models/Authentication_model.php */