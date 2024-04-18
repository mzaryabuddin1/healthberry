<?php defined('BASEPATH') or exit('No direct script access allowed');

class checksession {
    public function validatesession(){
        if ( !isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
			header("Location: " . base_url() . 'login?error=Please Login First');
			exit;
		}
    }
}

$checksession = new checksession();
