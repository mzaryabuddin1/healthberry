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
  public function get_app_users()
  {
    return $this->db->select("*")->from('app_users')->get()->result_array();
  }
  
  // ------------------------------------------------------------------------
  public function save_data($name, $email, $password, $roles, $created_at,$status)
  {
    $data = array(
      'name' => $name,
      'email' => $email,
      'password' => $password,
      'roles' => $roles,
      'created_at' => $created_at,
      'status' => $status
    );

    return $this->db->insert('users', $data);
  }
  public function save_data_app_user($username, $password, $created_at, $file_url)
  {
    $data = array(
      'username' => $username,
      'password' => $password,
      'profile_picture' => $file_url,
      'created_at' => $created_at,
      "created_by" => $_SESSION['user_id']
    );

    return $this->db->insert('app_users', $data);
  }
  public function get_user_row($id)
  {
    return $this->db->select("*")->from('users')->where("id", $id)->get()->row_array();
  }
  public function update_data($name, $email, $password, $roles,$status,$id)
  {
    $data = array(
      'name' => $name,
      'email' => $email,
      'roles' => $roles,
      'status' => $status
    );
    if($password!==''){
      $data['password']=md5($password);
    }
    $this->db->where('id', $id);
    return $this->db->update('users', $data);
  }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */