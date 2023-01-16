<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Login extends CI_Controller

{

    public function __construct() {
        parent::__construct();
        // if (!defined('ROUTE_ACCESS'))
        //     exit("<h1 align='center'>Access Denied!</h1>");
    }

    function index() { 
        redirect('/admin/login', 'refresh');
    	//_e("<h1 align='center'>Access Denied!</h1>");
        // $this->load->view('welcome');
    }

}

