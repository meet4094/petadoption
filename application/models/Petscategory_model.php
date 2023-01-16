<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Petscategory_model extends CI_Model

{


    public function getPetscategorys($params = [])

    {

        if (!empty($params['queryString'])) {

            $this->db->like('name', $params['queryString']);
        }

        $admin = $this->db->get('pets_category')->result_array();

        return $admin;
    }

    public function getPetscategory($id)

    {

        $this->db->where('id', $id);

        $results = $this->db->get('pets_category')->row_array();

        return $results;
    }

    public function create($formArray)

    {

        $this->db->insert('pets_category', $formArray);
    }

    public function update($id, $formArray)

    {

        $this->db->where('id', $id);

        $this->db->update('pets_category', $formArray);
    }



    public function delete($id)

    {

        $this->db->where('id', $id);

        $this->db->delete('pets_category');
    }
}
