<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pets extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!defined('ROUTE_ACCESS'))
            exit('No Access');
        $this->load->model("model_pets");
    }

    function index()
    {
        _e("<h1><center>Access Denied!!</center></h1>");
    }

    function addPets()
    {
        $iRes = $this->validate->addPets($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->addPets($iRes['data']);
        response($iProfile);
    }

    function updatePets($Id)
    {
        $iRes = $this->validate->updatePets($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->updatePets($iRes['data'], $Id);
        response($iProfile);
    }


    function getPets()
    {
        $iRes = $this->validate->getPets($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->getPets($iRes['data']);
        response($iProfile);
    }

    function deletePets($Id)
    {
        $iResult = $this->model_pets->deletePets($Id);
        response($iResult);
    }

    function getPetscategory()
    {
        $iRes = $this->validate->getPetscategory($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->getPetscategory($iRes['data']);
        response($iProfile);
    }

    function addPetscategory()
    {
        $iRes = $this->validate->addPetscategory($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->addPetscategory($iRes['data']);
        response($iProfile);
    }

    function savepets()
    {
        $iRes = $this->validate->savepets($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->savepets($iRes['data']);
        response($iProfile);
    }

    function getsavepets()
    {
        $iRes = $this->validate->getsavepets($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->getsavepets($iRes['data']);
        response($iProfile);
    }

    function deletePetsSave($Id)
    {
        $iResult = $this->model_pets->deletePetsSave($Id);
        response($iResult);
    }

    function addPetslike()
    {
        $iRes = $this->validate->addPetslike($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->addPetslike($iRes['data']);
        response($iProfile);
    }

    function PetsShare()
    {
        $iRes = $this->validate->PetsShare($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->PetsShare($iRes['data']);
        response($iProfile);
    }

    function PetsComment()
    {
        $iRes = $this->validate->PetsComment($this->param);
        if ($iRes['statuscode'] != 1)
            response($iRes);
        $iProfile = $this->model_pets->PetsComment($iRes['data']);
        response($iProfile);
    }
}
