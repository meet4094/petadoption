<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        echo "<center>Welcome to Admin Panel.</center>";
    }

    function dashboard()
    {

        $iQry = "SELECT COUNT(id) cnt FROM pets_category";
        $iCategoryCount = $this->model_api->execute_query($iQry);
        $iDashboard['iCategoryCount'] = isset($iCategoryCount['data'][0]['cnt']) ? $iCategoryCount['data'][0]['cnt'] : 0;

        $iQry = "SELECT COUNT(id) cnt FROM pets_details";
        $iPetsDetailesCount = $this->model_api->execute_query($iQry);
        $iDashboard['iPetsDetailesCount'] = isset($iPetsDetailesCount['data'][0]['cnt']) ? $iPetsDetailesCount['data'][0]['cnt'] : 0;

        $iQry = "SELECT COUNT(id) cnt FROM pets_photos";
        $iPetsPhotoCount = $this->model_api->execute_query($iQry);
        $iDashboard['iPetsPhotoCount'] = isset($iPetsPhotoCount['data'][0]['cnt']) ? $iPetsPhotoCount['data'][0]['cnt'] : 0;

        $iQry = "SELECT COUNT(uid) cnt FROM sh_users";
        $iUserCount = $this->model_api->execute_query($iQry);
        $iDashboard['iUserCount'] = isset($iUserCount['data'][0]['cnt']) ? $iUserCount['data'][0]['cnt'] : 0;

        $this->load->view('admin/dashboard', $iDashboard);
    }
}
