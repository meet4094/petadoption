<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!defined('ROUTE_ACCESS'))
            exit('No Access');
        $this->load->model("model_user");
    }

    function index()
    {
        _e("<h1><center>Access Denied!!</center></h1>");
    }

    function signUp()
    {
        $iRes = $this->validate->signUp($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_user->signUp($iRes['data']);
        response($iProfile);
    }

    function getsignUp()
    {
        $iRes = $this->validate->getsignUp($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_user->getsignUp($iRes['data']);
        response($iProfile);
    }

    function logIn()
    {
        $iRes = $this->validate->logIn($this->param);
        if ($iRes['statuscode'] != 1) {
            $this->mylib->create_activity("login_try", "user");
            response($iRes);
        }
        $iLogin = $this->model_user->logIn($iRes['data']);
        response($iLogin);
    }

    function updateProfile()
    {
        $iRes = $this->validate->updateProfile($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_user->updateProfile($iRes['data']);
        response($iProfile);
    }
}
