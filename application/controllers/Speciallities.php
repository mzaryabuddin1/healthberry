<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Specialities
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Specialities extends CI_Controller
{
    
  public function __construct()
    {
        parent::__construct();
        $this->checksession->validatesession();
        if ($_SESSION['user_roles'] != 'admin') {
            header("Location: " . base_url() . 'login?error=Unauthorized Access');
        }
        $this->load->model('Specialities_model');

    }

    public function index()
    {
        $data['data'] = $this->Specialities_model->get_Specialities();
        $this->load->view('manage_specialities_view', $data);
    }
    public function add()
    {
        $this->load->view('add_specialities_view', $data);
    }
    

}


/* End of file Specialities.php */
/* Location: ./application/controllers/Specialities.php */