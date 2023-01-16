<?php

defined('BASEPATH') or exit('No direct script access allowed');



class PetsUsers_model extends CI_Model

{
    public function getPetsUsers($params = [])

    {

        if (!empty($params['queryName'])) {

            $this->db->like('name', $params['queryName']);
        }

        if (!empty($params['queryEmail'])) {

            $this->db->like('email', $params['queryEmail']);
        }

        if (!empty($params['queryMobilenumber'])) {

            $this->db->like('mobile_number', $params['queryMobilenumber']);
        }

        if (!empty($params['queryIs_del'])) {

            $this->db->like('is_del', $params['queryIs_del']);
        }

        $results = $this->db->get('sh_users')->result_array();

        return $results;
    }

    public function getPetsUserDetaile($id)

    {

        $this->db->where('user_id', $id);
        $results = $this->db->get('pets_details')->result_array();

        foreach ($results as $key => $result) {
            $id = $result['id'];
            $this->db->where('pet_id', $id);
            $PetsDetailes = $this->db->get('pets_photos')->result_array();
            $results[$key]['PetsPhoto'] = $PetsDetailes;
        }
        return $results;
    }
}
