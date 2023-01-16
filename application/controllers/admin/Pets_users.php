<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Pets_users extends MY_Controller

{

    public function __construct()
    {
        parent::__construct();
    }



    //this method will show Pets_users list page

    public function view()

    {

        $this->load->model('Petsusers_model');

        $queryName = $this->input->get('q');
        $params['queryName'] = $queryName;
        $queryEmail = $this->input->get('e');
        $params['queryEmail'] = $queryEmail;
        $queryMobilenumber = $this->input->get('m');
        $params['queryMobilenumber'] = $queryMobilenumber;
        $queryIs_del = $this->input->get('m');
        $params['queryIs_del'] = $queryIs_del;

        $PetsUsers = $this->Petsusers_model->getPetsUsers($params);

        $data['PetsUsers'] = $PetsUsers;
        $data['queryName'] = $queryName;
        $data['queryEmail'] = $queryEmail;
        $data['queryMobilenumber'] = $queryMobilenumber;
        $data['queryIs_del'] = $queryIs_del;

        $this->load->view('admin/Pets_users/view', $data);
    }

    public function petsdetails($id)
    {

        $this->load->model('Petsusers_model');

        $PetsDetailes = $this->Petsusers_model->getPetsUserDetaile($id);
        $data['PetsDetailes'] = $PetsDetailes;

        $this->load->view('admin/Pets_users/petsdetails', $data);
    }
}
