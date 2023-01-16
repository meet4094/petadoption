<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pets_detailes extends MY_Controller

{

    public function __construct()
    {
        parent::__construct();
    }

    //this method will show Pets_detailes list page

    public function view()
    {
        $iQry = "SELECT pets_details.name as categoryname FROM pets_details JOIN pets_category ON (pets_category.id = pets_details.pets_category) ORDER BY pets_details.id";
        $iDataLists = $this->model_api->execute_query($iQry);

        $this->load->model('PetsDetailes_model');
        $this->load->model('Petscategory_model');

        $Petscategories = $this->Petscategory_model->getPetscategorys();
        $data['petscategories'] = $Petscategories;

        $PetsDetailes = $this->PetsDetailes_model->getPetsDetailes();
        $data['PetsDetailes'] = $PetsDetailes;

        $data['categoryname'] = $iDataLists;
        // $data['PetsDetailes'] = $iDataLists;
        $this->load->view('admin/Pets_detailes/view', $data);
    }

    public function details($id)
    {

        $this->load->model('PetsDetailes_model');

        $PetsDetailes = $this->PetsDetailes_model->getPetsDetaile($id);
        $data['PetsDetaile'] = $PetsDetailes;

        $PetsPhotos = $this->PetsDetailes_model->getPetsPhotos($id);
        $data['PetsPhotos'] = $PetsPhotos;

        $this->load->view('admin/Pets_detailes/details', $data);
    }

    function load_festivalimage()
    {
        $iWhere = " WHERE pets_details.id IS NOT NULL";
        if (isset($this->param['action']) && $this->param['action'] == 'filter') {
            if (isset($this->param['name']) && $this->param['name'] != '')
                $iWhere .= " AND pets_details.name LIKE '%" . $this->param['name'] . "%'";
            if (isset($this->param['category_id']) && $this->param['category_id'] != '')
                $iWhere .= " AND pets_details.category_id = " . $this->param['category_id'];
            if (isset($this->param['is_del']) && $this->param['is_del'] != '')
                $iWhere .= " AND pets_details.is_del = " . $this->param['is_del'];
        }

        $iResCount = $this->model_api->execute_query("SELECT COUNT(pets_details.id) cnt FROM pets_details JOIN sh_festivalcategory ON (sh_festivalcategory.id = pets_details.category_id) " . $iWhere);
        $iTotalRecords = isset($iResCount['data'][0]['cnt']) ? $iResCount['data'][0]['cnt'] : 0;
        $iDisplayLength = intval($this->param['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->param['start']);
        $sEcho = intval($this->param['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $statusList = array(
            array("success" => "Enable"),
            array("danger" => "Disable")
        );

        $iLimit = "LIMIT " . $iDisplayStart . ", " . $iDisplayLength;
        $iQry = "SELECT pets_details.id,pets_details.name,pets_details.image,pets_details.description,pets_details.category_id,pets_details.language_id,pets_details.created_date,pets_details.is_del,sh_festivalcategory.name as festivalcategoryname,sh_language.name as languagename FROM pets_details JOIN sh_festivalcategory ON (sh_festivalcategory.id = pets_details.category_id) JOIN sh_language ON (sh_language.id = pets_details.language_id) {$iWhere} ORDER BY pets_details.id DESC {$iLimit}";
        $iDataLists = $this->model_api->execute_query($iQry);

        foreach ($iDataLists['data'] as $key => $iData) {
            if (isset($iData['image']) && $iData['image'] != "")
                // $iData['image'] = '<a target="_blank" href="' . FESTIVALIMAGE_IMAGE_URL . DS . $iData['image'] . '"><img width="150" src="' . FESTIVALIMAGE_IMAGE_URL . DS . $iData['image'] . '"/></a>';
                $iStatus = $statusList[$iData['is_del']];
            $records["data"][] = array(
                $iData['id'],
                $iData['name'],
                $iData['description'],
                $iData['festivalcategoryname'],
                $iData['image'],
                $iData['languagename'],
                date("d M, Y g:i A", strtotime($iData['created_date'])),
                '<span class="label label-sm label-' . (key($iStatus)) . '">' . (current($iStatus)) . '</span>',
                '<a href="' . BASE_URL . "admin/festivalimage/edit/" . $iData['id'] . '" class="btn btn-sm btn-outline blue"><i class="fa fa-edit"></i> Edit</a> <a href="' . BASE_URL . "admin/festivalimage/delete/" . $iData['id'] . '" class="btn btn-sm btn-outline red"><i class="fa fa-trash"></i> Delete</a>',
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
}
