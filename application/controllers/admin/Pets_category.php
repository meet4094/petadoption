<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Pets_category extends MY_Controller

{

    public function __construct()
    {
        parent::__construct();
    }

    //this method will show Pets_category list page

    public function view()

    {

        $this->load->model('Petscategory_model');

        $queryString = $this->input->get('q');

        $params['queryString'] = $queryString;

        $Petscategories = $this->Petscategory_model->getPetscategorys($params);

        $data['petscategories'] = $Petscategories;

        $data['queryString'] = $queryString;

        $this->load->view('admin/pets_category/view', $data);
    }

    //this method will show Pets_category create page

    public function create()

    {

        $this->load->model('Petscategory_model');

        $this->load->library('form_validation');



        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');


        $config['upload_path'] = PETCATEGORY_IMAGE_PATH . DS;

        $config['allowed_types'] = 'gif|jpg|png';

        $config['encrypt_name'] = true;



        $this->load->library('upload', $config);



        if ($this->form_validation->run() == true) {



            if (!empty($_FILES['category_image']['name'])) {

                //Now user has selected a file so we will proceed



                if ($this->upload->do_upload('category_image')) {

                    //File uploaded successfully



                    $data = $this->upload->data();



                    //we will create category without image

                    $formArray['category_image'] = $data['file_name'];

                    $formArray['name'] = $this->input->post('name');

                    $formArray['is_del'] = $this->input->post('is_del');

                    $this->Petscategory_model->create($formArray);

                    $this->session->set_flashdata('success', 'Category added successfully');

                    redirect(base_url() . 'admin/pets_category/view');
                } else {

                    //We got some errors

                    $error = $this->upload->display_errors("<p class='invalid-feedback'>", '</p>');

                    $data['errorImageUpload'] = $error;

                    $this->load->view('admin/pets_category/create', $data);
                }
            } else {

                //we will create category without image

                $formArray['name'] = $this->input->post('name');

                $formArray['is_del'] = $this->input->post('is_del');

                $formArray['created_at'] = date('Y-m-d H-i-s');

                $this->Petscategory_model->create($formArray);

                $this->session->set_flashdata('success', 'Category added successfully');

                redirect(base_url() . 'admin/pets_category/view');
            }
        } else {

            //will show errors

            $this->load->view('admin/pets_category/create');
        }
    }

    //this method will show Pets_category edit page

    public function edit($id)

    {

        $this->load->model('Petscategory_model');

        $category = $this->Petscategory_model->getPetscategory($id);



        if (empty($category)) {

            $this->session->set_flashdata('error', 'Category not found');

            redirect(base_url() . 'admin/pets_category/view');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');


        $config['upload_path'] = PETCATEGORY_IMAGE_PATH . DS;

        $config['allowed_types'] = 'gif|jpg|png';

        $config['encrypt_name'] = true;



        $this->load->library('upload', $config);



        if ($this->form_validation->run() == true) {



            if (!empty($_FILES['category_image']['name'])) {

                //Now user has selected a file so we will proceed



                if ($this->upload->do_upload('category_image')) {

                    //File uploaded successfully



                    $data = $this->upload->data();



                    //we will create category without image

                    $formArray['category_image'] = $data['file_name'];

                    $formArray['name'] = $this->input->post('name');

                    $formArray['is_del'] = $this->input->post('is_del');



                    $this->Petscategory_model->update($id, $formArray);


                    $this->session->set_flashdata('success', 'Category updated successfully');

                    redirect(base_url() . 'admin/pets_category/view');
                } else {

                    //We got some errors

                    $error = $this->upload->display_errors("<p class='invalid-feedback'>", '</p>');

                    $data['errorImageUpload'] = $error;

                    $data['category'] = $category;

                    $this->load->view('admin/pets_category/edit', $data);
                }
            } else {

                //we will create category without image

                $formArray['name'] = $this->input->post('name');

                $formArray['is_del'] = $this->input->post('is_del');

                $this->Petscategory_model->update($id, $formArray);

                $this->session->set_flashdata('success', 'Category updated successfully');

                redirect(base_url() . 'admin/pets_category/view');
            }
        } else {

            $data['category'] = $category;

            $this->load->view('admin/pets_category/edit', $data);
        }
    }



    //this method will show Pets_category delete page

    public function delete($id)

    {

        $this->load->model('Petscategory_model');

        $category = $this->Petscategory_model->getPetscategory($id);



        if (empty($category)) {

            $this->session->set_flashdata('error', 'Category not found');

            redirect(base_url() . 'admin/pets_category/view');
        }


        if (file_exists(PETCATEGORY_IMAGE_PATH . DS . $category['category_image'])) {

            unlink(PETCATEGORY_IMAGE_PATH . DS . $category['category_image']);
        }

        $this->Petscategory_model->delete($id);



        $this->session->set_flashdata('success', 'Category deleted successfully');

        redirect(base_url() . 'admin/pets_category/view');
    }

    function load_petscategory()
    {
        $iWhere = " WHERE id IS NOT NULL";
        if (isset($this->param['action']) && $this->param['action'] == 'filter') {
            if (isset($this->param['name']) && $this->param['name'] != '')
                $iWhere .= " AND name LIKE '%" . $this->param['name'] . "%'";
            if (isset($this->param['is_del']) && $this->param['is_del'] != '')
                $iWhere .= " AND is_del = " . $this->param['is_del'];
        }

        $iResCount = $this->model_api->execute_query("SELECT COUNT(id) cnt FROM pets_category " . $iWhere);
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
        $iQry = "SELECT id,name,category_image,created_date,modified_date,status,is_del FROM pets_category {$iWhere} ORDER BY id DESC {$iLimit}";
        $iDataLists = $this->model_api->execute_query($iQry);

        foreach ($iDataLists['data'] as $key => $iData) {
            if (isset($iData['image']) && $iData['image'] != "")
                $iData['image'] = '<a target="_blank" href="' . PETCATEGORY_IMAGE_URL . DS . $iData['image'] . '"><img width="150" src="' . PETCATEGORY_IMAGE_URL . DS . $iData['image'] . '"/></a>';
            $iStatus = $statusList[$iData['is_del']];
            $records["data"][] = array(
                $iData['id'],
                $iData['name'],
                date("d M, Y g:i A", strtotime($iData['created_date'])),
                date("d M, Y", strtotime($iData['modified_date'])),
                $iData['category_image'],
                '<span class="label label-sm label-' . (key($iStatus)) . '">' . (current($iStatus)) . '</span>',
                '<a href="' . BASE_URL . "admin/pets_category/edit/" . $iData['id'] . '" class="btn btn-sm btn-outline blue"><i class="fa fa-edit"></i> Edit</a> <a href="' . BASE_URL . "admin/pets_category/delete/" . $iData['id'] . '" class="btn btn-sm btn-outline red"><i class="fa fa-trash"></i> Delete</a>',
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
}
