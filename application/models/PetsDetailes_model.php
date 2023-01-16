<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PetsDetailes_model extends CI_Model

{
    public function getPetsDetailes()
    {
        $results = $this->db->get('pets_details')->result_array();
        foreach ($results as $key => $result) {
            $id = $result['id'];
            $this->db->where('pet_id', $id);
            $PetsDetailes = $this->db->get('pets_photos')->result_array();
            $results[$key]['PetsDetailes'] = $PetsDetailes;
        }
        return $results;
    }

    public function getPetsPhoto()

    {
        $results = $this->db->get('pets_photos')->result_array();

        return $results;
    }

    public function getPetsDetaile($id)

    {

        $this->db->where('id', $id);
        $results = $this->db->get('pets_details')->row_array();

        return $results;
    }

    public function getPetsPhotos($id)

    {

        $this->db->where('pet_id', $id);
        $results = $this->db->get('pets_photos')->result_array();

        return $results;
    }
}
