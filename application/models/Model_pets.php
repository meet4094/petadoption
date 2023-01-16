<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_pets extends CI_Model
{
    public static $defaultFields = array();

    public function __construct()
    {
        parent::__construct();
        self::$defaultFields = array(
            "name" => array("type" => "string", "default" => "", "protected" => 0),
            "gender" => array("type" => "integer", "default" => 1, "protected" => 1),
            "breed" => array("type" => "string", "default" => "", "protected" => 0),
            "weight" => array("type" => "string", "default" => "", "protected" => 0),
            "color" => array("type" => "string", "default" => "", "protected" => 0),
            "address" => array("type" => "string", "default" => "", "protected" => 0),
            "about" => array("type" => "string", "default" => "", "protected" => 0),
            "age" => array("type" => "string", "default" => "", "protected" => 0),
            "pets_category" => array("type" => "string", "default" => "", "protected" => 0),
            // "pets_id" => array("type" => "string", "default" => "", "protected" => 0),
            // "pets_like" => array("type" => "string", "default" => "", "protected" => 0),
            "created_date" => array("type" => "datetime", "default" => date("Y-m-d H:i:s"), "protected" => 1),
            "modified_date" => array("type" => "datetime", "default" => date("Y-m-d H:i:s"), "protected" => 1),
            "is_del" => array("type" => "integer", "default" => 0, "protected" => 1),
        );
    }

    function petsLikeDetail($userDeviceDetail)
    {
        $this->model_api->delete('pets_like', array("and" => array("user_id" => $userDeviceDetail['user_id'], "pets_id" => $userDeviceDetail['pets_id']))); // Single Login -- Delete old Auth-Token.
        $loginId = $this->validateDeviceLike($userDeviceDetail['pets_like']);
        if ($loginId == 0) {
            $userDeviceDetail['created_date'] = date("Y-m-d H:i:s");
            $iStatus = $this->model_api->add('pets_like', $userDeviceDetail);
            if (!isset($iStatus['data']['id']) || $iStatus['statuscode'] != 1)
                return $iStatus;
        } else {
            $userDeviceDetail['modified_date'] = date("Y-m-d H:i:s");
            $iStatus = $this->model_api->update('pets_like', $userDeviceDetail, array("and" => array("id" => $loginId)));
            if ($iStatus['statuscode'] != 1)
                return $iStatus;
        }
        return $iStatus;
    }

    function petsSaveDetail($userDeviceDetail)
    {
        $this->model_api->delete('pets_save', array("and" => array("user_id" => $userDeviceDetail['user_id'], "pets_id" => $userDeviceDetail['pets_id']))); // Single Login -- Delete old Auth-Token.
        $loginId = $this->validateDeviceSave($userDeviceDetail['pets_save']);
        if ($loginId == 0) {
            $userDeviceDetail['created_date'] = date("Y-m-d H:i:s");
            $iStatus = $this->model_api->add('pets_save', $userDeviceDetail);
            if (!isset($iStatus['data']['id']) || $iStatus['statuscode'] != 1)
                return $iStatus;
        } else {
            $userDeviceDetail['modified_date'] = date("Y-m-d H:i:s");
            $iStatus = $this->model_api->update('pets_save', $userDeviceDetail, array("and" => array("id" => $loginId)));
            if ($iStatus['statuscode'] != 1)
                return $iStatus;
        }
        return $iStatus;
    }

    function validateDeviceLike($petslike = '')
    {
        if (!empty($petslike)) {
            $deviceData = $this->model_api->get('pets_like', array("id"), array("or" => array("pets_like" => $petslike)));
            return isset($deviceData['data'][0]['id']) ? $deviceData['data'][0]['id'] : 0;
        } else {
            return 0;
        }
    }
    function validateDeviceSave($petssave = '')
    {
        if (!empty($petssave)) {
            $deviceData = $this->model_api->get('pets_save', array("id"), array("or" => array("pets_save" => $petssave)));
            return isset($deviceData['data'][0]['id']) ? $deviceData['data'][0]['id'] : 0;
        } else {
            return 0;
        }
    }

    function uploadpetsPhotos($Id, $photoCount)
    {
        for ($x = 1; $x <= $photoCount; $x++) {
            $iExt = strtolower(substr($_FILES['photo' . $x]['name'], strrpos($_FILES['photo' . $x]['name'], ".") + 1));
            $fileName = md5($Id . time() . uniqid()) . "." . $iExt;
            check_and_create_directory(PET_IMAGE_PATH . DS);
            move_uploaded_file($_FILES['photo' . $x]['tmp_name'], PET_IMAGE_PATH . DS . $fileName);

            $inserted_fields['pet_id'] = $Id;
            $inserted_fields['photo'] = $fileName;
            $this->model_api->add('pets_photos', $inserted_fields);
        }

        $iRes = success_res("success");
        return $iRes;
    }

    function updatepetsPhotos($Id, $photoCount)
    {
        for ($x = 1; $x <= $photoCount; $x++) {
            $mInfo = $this->model_api->get('pets_photos', array("photo"), array("and" => array("pet_id" => $Id)));
            $iExt = strtolower(substr($_FILES['photo' . $x]['name'], strrpos($_FILES['photo' . $x]['name'], ".") + 1));
            $fileName = md5($Id . time() . uniqid()) . "." . $iExt;
            check_and_create_directory(PET_IMAGE_PATH . DS);
            move_uploaded_file($_FILES['photo' . $x]['tmp_name'], PET_IMAGE_PATH . DS . $fileName);

            $iPhoto['photo' . $x] = $fileName;
            $this->model_api->update('pets_photos', array('photo' => $fileName), update);
            if (isset($mInfo['data'][0]['photo' . $x]) && !empty($mInfo['data'][0]['photo' . $x]))
                file_exists(PET_IMAGE_PATH . DS . $mInfo['data'][0]['photo' . $x]) ? unlink(PET_IMAGE_PATH . DS . $mInfo['data'][0]['photo' . $x]) : "";
        }

        $iRes = success_res("success");
        $iRes['data'] = $iPhoto;
        return $iRes;
    }

    function petsDetailById($Id = 0)
    {
        $iQuery = "SELECT * FROM pets_details WHERE id = {$Id}";
        $iUser = $this->model_api->execute_query($iQuery);
        if (!isset($iUser['data'][0]['id']))
            return error_res("invalid_data");
        $iUser = $iUser['data'][0];

        $iQuery = "SELECT pet_id,photo FROM pets_photos WHERE pet_id = {$Id} AND is_del = 0";
        $iPetsDetailsPhotos = $this->model_api->execute_query($iQuery);

        foreach ($iPetsDetailsPhotos['data'] as $petphotokey => $iPetsDetailsPhoto) {
            if (isset($iPetsDetailsPhoto['photo']) && !empty($iPetsDetailsPhoto['photo']))
                $iPetsDetailsPhotos['data'][$petphotokey]['photo'] = PET_IMAGE_URL . DS . $iPetsDetailsPhoto['photo'];
        }
        $iUser['photos'] = $iPetsDetailsPhotos['data'];
        return $iUser;
    }

    function petsCategoryDetailById($Id = 0)
    {
        $iQuery = "SELECT * FROM pets_category WHERE id = {$Id}";
        $iUser = $this->model_api->execute_query($iQuery);
        if (!isset($iUser['data'][0]['id']))
            return error_res("invalid_data");
        $iUser = $iUser['data'][0];
        if (isset($iUser['category_image']) && !empty($iUser['category_image']))
            $iUser['category_image'] = PETCATEGORY_IMAGE_URL . DS . $iUser['category_image'];

        return $iUser;
    }

    function addPets($param)
    {
        $defaultFields = get_default_fields(self::$defaultFields);
        $iArrayDiff = array_diff_key($defaultFields, $param);
        $insertedFields = array_intersect_key($param, $defaultFields);
        $insertedFields = array_merge($insertedFields, $iArrayDiff);
        $iStatus = $this->model_api->add('pets_details', $insertedFields);
        if (!isset($iStatus['data']['id']) || $iStatus['statuscode'] != 1)
            return $iStatus;

        $Id = $iStatus['data']['id'];
        $param['id'] = $Id;

        $iUser = $this->model_api->get('pets_details', array("id,name,gender,breed,weight,color,address,about,age,pets_category,created_date,modified_date,is_del"), array("and" => array("id" => $Id)));
        if (!isset($iUser['statuscode']) || $iUser['statuscode'] != 1)
            return error_res("invalid_data");

        $photoCount = isset($param['photo_count']) ? $param['photo_count'] : 0;
        if ($photoCount > 0) {
            $this->uploadpetsPhotos($Id, $photoCount);
        }

        $iUser = $this->petsDetailById($Id);
        $iStatus = success_res("pets_details_created");
        return $iStatus;
    }

    function updatePets($param, $Id)
    {
        $defaultFields = get_default_fields(self::$defaultFields);
        $updateFields = array_intersect_key($param, $defaultFields);

        $iUpdate = $this->model_api->update('pets_details', $updateFields, array("and" => array("id" => $Id)));
        if (!isset($iUpdate['statuscode']) || $iUpdate['statuscode'] != 1)
            return error_res("invalid_data");

        $photoCount = isset($param['photo_count']) ? $param['photo_count'] : 0;
        if ($photoCount > 0) {
            $this->updatepetsPhotos($Id, $photoCount);
        }

        $iUser = $this->petsDetailById($Id);
        $iData = success_res("pets_updated");
        $iData['data'] = $iUser;
        return $iData;
    }

    function deletePets($Id)
    {
        $iStatus = $this->model_api->delete('pets_details', array("and" => array("id" => $Id, "is_del" => '0')));
        $iStatus = $this->model_api->delete('pets_photos', array("and" => array("pet_id" => $Id, "is_del" => '0')));
        if ($iStatus['statuscode'] != '1')
            return $iStatus;
        return success_res("delete_successfully");
    }

    function getPets($param)
    {
        $iStart = isset($param['start']) ? $param['start'] : 0;
        $iLen = isset($param['len']) ? $param['len'] : 10;
        $searchKey = isset($param['search_key']) ? $param['search_key'] : '';
        $iCategoryId = isset($param['category_id']) ? $param['category_id'] : 0;


        $iLimit = '';
        if ($iStart != '-1')
            $iLimit = "LIMIT {$iStart},{$iLen}";
        $iWhere = " WHERE is_del = 0";

        if ($searchKey != '')
            $iWhere .= " AND name LIKE '%$searchKey%'";

        if ($iCategoryId != 0)

            $iWhere .= " AND pets_category = $iCategoryId";

        $iQuery = "SELECT id,name,gender,breed,weight,color,age,address,about,pets_category,created_date,modified_date,is_del FROM pets_details {$iWhere} ORDER BY pets_details.id DESC {$iLimit}";
        $iPetsDetails = $this->model_api->execute_query($iQuery);
        if (!isset($iPetsDetails['statuscode']) || $iPetsDetails['statuscode'] != 1)
            return error_res("invalid_data");

        if (isset($iPetsDetails['data']) && count($iPetsDetails['data']) > 0) {
            foreach ($iPetsDetails['data'] as $petkey => $iPetsDetail) {
                $petId = $iPetsDetail['id'];

                $iQuery = "SELECT id,photo FROM pets_photos WHERE pet_id = {$petId} AND is_del = 0";
                $iPetsDetailsPhotos = $this->model_api->execute_query($iQuery);
                foreach ($iPetsDetailsPhotos['data'] as $petphotokey => $iPetsDetailsPhoto) {
                    if (isset($iPetsDetailsPhoto['photo']) && !empty($iPetsDetailsPhoto['photo']))
                        $iPetsDetailsPhotos['data'][$petphotokey]['photo'] = PET_IMAGE_URL . DS . $iPetsDetailsPhoto['photo'];
                }
                $iQry = "SELECT COUNT(pets_id) cnt FROM pets_like WHERE pets_id = {$petId} AND pets_like = 0";
                $iLikeCount = $this->model_api->execute_query($iQry);
                $iPetsDetails['data'][$petkey]['iLikeCount'] = isset($iLikeCount['data'][0]['cnt']) ? $iLikeCount['data'][0]['cnt'] : 0;

                $iQrye = "SELECT COUNT(pets_id) cnt FROM pets_share WHERE pets_id = {$petId}";
                $iShareCount = $this->model_api->execute_query($iQrye);
                $iPetsDetails['data'][$petkey]['iShareCount'] = isset($iShareCount['data'][0]['cnt']) ? $iShareCount['data'][0]['cnt'] : 0;

                $iPetsDetails['data'][$petkey]['photos'] = $iPetsDetailsPhotos['data'];
            }
        }
        $iRes = success_res("success");
        $iRes = $iPetsDetails;
        return $iRes;
    }

    function getPetscategory($param)
    {
        $iStart = isset($param['start']) ? $param['start'] : 0;
        $iLen = isset($param['len']) ? $param['len'] : 10;
        $searchKey = isset($param['search_key']) ? $param['search_key'] : '';
        $iCategoryId = isset($param['category_id']) ? $param['category_id'] : 0;

        $iLimit = '';
        if ($iStart != '-1')
            $iLimit = "LIMIT {$iStart},{$iLen}";
        $iWhere = " WHERE is_del = 0";

        if ($searchKey != '')
            $iWhere .= " AND name LIKE '%$searchKey%'";

        if ($iCategoryId != 0)

            $iWhere .= " AND id = $iCategoryId";

        $iQuery = "SELECT id,category_image,name,created_date,modified_date,is_del FROM pets_category {$iWhere} ORDER BY id DESC {$iLimit}";
        $iCharacterList = $this->model_api->execute_query($iQuery);
        if (!isset($iCharacterList['statuscode']) || $iCharacterList['statuscode'] != 1)
            return error_res("invalid_data");

        if (isset($iCharacterList['data']) && count($iCharacterList['data']) > 0) {
            foreach ($iCharacterList['data'] as $key => $iCharacter) {
                $Id = $iCharacter['id'];

                if (isset($iCharacter['category_image']) && !empty($iCharacter['category_image']))
                    $iCharacterList['data'][$key]['category_image'] = PETCATEGORY_IMAGE_URL . DS . $iCharacter['category_image'];

                $iQuery = "SELECT id,name,gender,breed,weight,color,age,address,about,pets_category,created_date,modified_date,is_del FROM pets_details WHERE pets_category = {$Id} AND is_del = 0";
                $ipetsdetailes = $this->model_api->execute_query($iQuery);
                foreach ($ipetsdetailes['data'] as $petkey => $iPetsDetail) {
                    $petId = $iPetsDetail['id'];

                    $iQuery = "SELECT id,photo FROM pets_photos WHERE pet_id = {$petId} AND is_del = 0";
                    $iPetsDetailsPhotos = $this->model_api->execute_query($iQuery);
                    foreach ($iPetsDetailsPhotos['data'] as $petphotokey => $iPetsDetailsPhoto) {
                        if (isset($iPetsDetailsPhoto['photo']) && !empty($iPetsDetailsPhoto['photo']))
                            $iPetsDetailsPhotos['data'][$petphotokey]['photo'] = PET_IMAGE_URL . DS . $iPetsDetailsPhoto['photo'];
                    }
                    $iQry = "SELECT COUNT(pets_id) cnt FROM pets_like WHERE pets_id = {$petId} AND pets_like = 0";
                    $iLikeCount = $this->model_api->execute_query($iQry);
                    $iPetsDetails['data'][$petkey]['iLikeCount'] = isset($iLikeCount['data'][0]['cnt']) ? $iLikeCount['data'][0]['cnt'] : 0;

                    $iPetsDetails['data'][$petkey]['photos'] = $iPetsDetailsPhotos['data'];
                }
            }
            $iCharacterList['data'][$key]['petsDetailes'] = $ipetsdetailes['data'];
        }

        $iCharacterList = $iCharacterList['data'];
        $iRes = success_res("success");
        $iRes['data'] = $iCharacterList;
        return $iRes;
    }

    function savepets($param)
    {
        $userId = isset($param['user_id']) ? $param['user_id'] : '';
        $petId = isset($param['pets_id']) ? $param['pets_id'] : '';
        $petLike = isset($param['pets_save']) ? $param['pets_save'] : '';

        $userDeviceDetail = array("user_id" => $userId, "pets_id" => $petId, "pets_save" => $petLike);
        $iUpdateStatus = $this->petsSaveDetail($userDeviceDetail);
        if ($iUpdateStatus['statuscode'] != 1)
            return $iUpdateStatus;

        $iUpdate = success_res("save_add");
        return $iUpdate;
    }

    function getsavepets($param)
    {

        $iStart = isset($param['start']) ? $param['start'] : 0;
        $iLen = isset($param['len']) ? $param['len'] : 10;
        $searchKey = isset($param['search_key']) ? $param['search_key'] : '';

        $iLimit = '';
        if ($iStart != '-1')
            $iLimit = "LIMIT {$iStart},{$iLen}";
        $iWhere = " WHERE pets_save = 0";

        if ($searchKey != '')
            $iWhere .= " AND name LIKE '%$searchKey%'";

        $iQuery = "SELECT id,user_id,pets_id FROM pets_save {$iWhere} ORDER BY pets_save.id DESC {$iLimit}";
        $iPetsSave = $this->model_api->execute_query($iQuery);
        if (!isset($iPetsSave['statuscode']) || $iPetsSave['statuscode'] != 1)
            return error_res("invalid_data");

        if (isset($iPetsSave['data']) && count($iPetsSave['data']) > 0) {
            foreach ($iPetsSave['data'] as $petkey => $iPetsDetail) {
                $petId = $iPetsDetail['pets_id'];

                $iQuery = "SELECT id,user_id,name,gender,breed,weight,color,age,address,about,pets_category,created_date,modified_date,is_del FROM pets_details WHERE id = {$petId} AND is_del = 0";
                $iPetsDetailsSaves = $this->model_api->execute_query($iQuery);
                $iPetsSave['data'][$petkey]['Savespets'] = $iPetsDetailsSaves['data'];

                foreach ($iPetsDetailsSaves['data'] as $key => $iPetsDetailsSave) {
                    $Id = $iPetsDetailsSave['id'];

                    $iQuery = "SELECT id,pet_id,photo FROM pets_photos WHERE pet_id = {$Id} AND is_del = 0";
                    $iPetsDetailsPhotos = $this->model_api->execute_query($iQuery);
                    foreach ($iPetsDetailsPhotos['data'] as $petphotokey => $iPetsDetailsPhoto) {
                        if (isset($iPetsDetailsPhoto['photo']) && !empty($iPetsDetailsPhoto['photo']))
                            $iPetsDetailsPhotos['data'][$petphotokey]['photo'] = PET_IMAGE_URL . DS . $iPetsDetailsPhoto['photo'];
                    }
                    $iPetsSave['data'][$petkey]['photos'] = $iPetsDetailsPhotos['data'];
                }
            }
        }

        $iRes = success_res("success");
        $iRes = $iPetsSave;
        return $iRes;
    }

    function deletePetsSave($Id)
    {
        $iStatus = $this->model_api->delete('pets_save', array("and" => array("id" => $Id, "is_del" => '0')));
        if ($iStatus['statuscode'] != '1')
            return $iStatus;
        return success_res("delete_successfully");
    }

    function addPetslike($param)
    {
        $userId = isset($param['user_id']) ? $param['user_id'] : '';
        $petId = isset($param['pets_id']) ? $param['pets_id'] : '';
        $petLike = isset($param['pets_like']) ? $param['pets_like'] : '';

        $userDeviceDetail = array("user_id" => $userId, "pets_id" => $petId, "pets_like" => $petLike);
        $iUpdateStatus = $this->petsLikeDetail($userDeviceDetail);
        if ($iUpdateStatus['statuscode'] != 1)
            return $iUpdateStatus;

        $iUpdate = success_res("Like_add");
        return $iUpdate;
    }

    function PetsShare($param)
    {
        $Id = user_id();
        $insertedFields = array_intersect_key($param);
        $insertedFields = array_merge($insertedFields);
        $iStatus = $this->model_api->add('pets_share', $insertedFields);
        if (!isset($iStatus['data']['id']) || $iStatus['statuscode'] != 1)
            return $iStatus;

        $Id = $iStatus['data']['id'];
        $param['id'] = $Id;

        $iUser = $this->model_api->get('pets_share', array("id,pets_id,created_date,is_del"), array("and" => array("id" => $Id)));
        if ($iUser['data'][0]['is_del'] == 1)
            return error_res("suspended_account");

        $iStatus = success_res("share_add");
        return $iStatus;
    }

    function PetsComment($param)
    {
        $Id = user_id();
        $insertedFields = array_intersect_key($param);
        $insertedFields = array_merge($insertedFields);
        $iStatus = $this->model_api->add('pets_comment', $insertedFields);
        if (!isset($iStatus['data']['id']) || $iStatus['statuscode'] != 1)
            return $iStatus;

        $Id = $iStatus['data']['id'];
        $param['id'] = $Id;

        $iUser = $this->model_api->get('pets_comment', array("id,pets_id,user_id,comment,created_date,is_del"), array("and" => array("id" => $Id)));
        if ($iUser['data'][0]['is_del'] == 1)
            return error_res("suspended_account");

        $iStatus = success_res("comment_add");
        return $iStatus;
    }
}
