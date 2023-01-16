<?php

use function PHPSTORM_META\type;

class Validate
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    function login_admin($param)
    {
        $param = array_map('trim', $param);
        if (!isset($param['email']) || empty($param['email']) || !_email($param['email']))
            return parameter_error_res("invalid_email");
        if (!isset($param['password']) || empty($param['password']))
            return parameter_error_res("password_missing");
        if (strlen($param['password']) < PASSWORD_MIN_LENGTH || strlen($param['password']) > PASSWORD_MAX_LENGTH)
            return parameter_error_res("password_min_max_length_violate", array(PASSWORD_MIN_LENGTH, PASSWORD_MAX_LENGTH));
        $interval_seconds = $this->CI->settings['unlock_login_interval'] * 3600; // hours to seconds
        $unlock_time = time() - $interval_seconds;
        $where = "is_ignore = 0 AND on_date > {$unlock_time}";
        $data = $this->CI->mylib->get_activity("login_try", ip(), "admin", $this->CI->settings['no_of_login_attampt'], $where);
        if (isset($data['data'][0]) && $data['statuscode'] == 1 && !empty($data['data'][0])) {
            if ($this->CI->settings['no_of_login_attampt'] < count($data['data']) + 1) {
                return spamer_res("too_much_attempt", array($this->CI->settings['unlock_login_interval']));
            }
        }

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function signUp($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("name", $keys) || empty($param['name']))
            return parameter_error_res("name_missing");

        if (!in_array("mobile_number", $keys) || empty($param['mobile_number']))
            return parameter_error_res("mobile_number_missing");

        if (!in_array("email", $keys) || empty($param['email']))
            return parameter_error_res("email_missing");
        if (in_array("email", $keys) && !_email($param['email']))
            return parameter_error_res("invalid_email");
        if ($this->CI->model_user->emailExist($param['email']))
            return parameter_error_res("email_exist");

        if (!in_array("password", $keys) || empty($param['password']))
            return parameter_error_res("password_missing");
        if (strlen($param['password']) < PASSWORD_MIN_LENGTH)
            return parameter_error_res("password_min_max_length_violate", array(PASSWORD_MIN_LENGTH));

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function logIn($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);

        if (!in_array("email", $keys) || empty($param['email']))
            return parameter_error_res("email_missing");
        if (!in_array("password", $keys) || empty($param['password']))
            return parameter_error_res("password_missing");
        if (strlen($param['password']) < PASSWORD_MIN_LENGTH)
            return parameter_error_res("password_min_max_length_violate", array(PASSWORD_MIN_LENGTH));

        $intervalSeconds = $this->CI->settings['unlock_login_interval'] * 60; // Minute to Seconds
        $unlockTime = time() - $intervalSeconds;
        $iWhere = "is_ignore = 0 AND on_date > {$unlockTime}";
        $iStatus = $this->CI->mylib->get_activity("login_try", ip(), "user", $this->CI->settings['no_of_login_attampt'], $iWhere);
        if (isset($iStatus['data'][0]) && $iStatus['statuscode'] == 1 && !empty($iStatus['data'][0])) {
            if ($this->CI->settings['no_of_login_attampt'] < count($iStatus['data']) + 1)
                return spamer_res("too_much_attempt", array($this->CI->settings['unlock_login_interval']));
        }

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function getsignUp($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (in_array("search_key", $keys) && empty($param['search_key']))
            return parameter_error_res("search_key_missing");
        if (!in_array("start", $keys) || empty($param['start']))
            $param['start'] = 0;
        if (!in_array("len", $keys) || empty($param['len']))
            $param['len'] = 10;

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function updateProfile($param)
    {
        // $uId = user_id();
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("name", $keys) || empty($param['name']))
            return parameter_error_res("first_name_missing");

        if (!in_array("mobile_number", $keys) && empty($param['mobile_number']))
            return parameter_error_res("mobile_number_missing");

        if (!in_array("address", $keys) || empty($param['address']))
            return parameter_error_res("address_missing");

        if (!isset($_FILES['avatar']['error']) || $_FILES['avatar']['error'] != 0)
            return parameter_error_res("photo_missing");
        if (isset($_FILES['avatar']['error']) && $_FILES['avatar']['error'] == 0) {
            $ext = strtolower(substr($_FILES['avatar']['name'], strrpos($_FILES['avatar']['name'], ".") + 1));
            $allowed_uploads_extensions = $this->CI->config->item("allow_image_upload_extensions");
            if (!in_array($ext, $allowed_uploads_extensions))
                return parameter_error_res("invalid_image_extension");
        }

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function addPets($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("name", $keys) || empty($param['name']))
            return parameter_error_res("name_missing");

        if (!in_array("gender", $keys) || empty($param['gender']))
            return parameter_error_res("gender_missing");

        if (!in_array("breed", $keys) || empty($param['breed']))
            return parameter_error_res("breed_missing");

        if (!in_array("weight", $keys) || empty($param['weight']))
            return parameter_error_res("weight_missing");

        if (!in_array("age", $keys) || empty($param['age']))
            return parameter_error_res("age_missing");

        if (!in_array("color", $keys) || empty($param['color']))
            return parameter_error_res("color_missing");

        if (!in_array("address", $keys) || empty($param['address']))
            return parameter_error_res("address_missing");

        if (!in_array("about", $keys) && empty($param['about']))
            return parameter_error_res("about_missing");

        if (!in_array("pets_category", $keys) && empty($param['pets_category']))
            return parameter_error_res("petcategory_missing");

        if (!in_array("photo_count", $keys) && empty($param['photo_count']))
            return parameter_error_res("photo_count_missing");
        $photo_count = isset($param['photo_count']) ? $param['photo_count'] : 0;

        for ($x = 1; $x <= $photo_count; $x++) {
            if (!isset($_FILES['photo' . $x]['error']) || $_FILES['photo' . $x]['error'] != 0)
                return parameter_error_res("photo_missing");
            if (isset($_FILES['photo' . $x]['error']) && $_FILES['photo' . $x]['error'] == 0) {
                $ext = strtolower(substr($_FILES['photo' . $x]['name'], strrpos($_FILES['photo' . $x]['name'], ".") + 1));
                $allowed_uploads_extensions = $this->CI->config->item("allow_image_upload_extensions");
                if (!in_array($ext, $allowed_uploads_extensions))
                    return parameter_error_res("invalid_image_extension");
            }
        }

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function updatePets($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("name", $keys) || empty($param['name']))
            return parameter_error_res("name_missing");

        if (!in_array("gender", $keys) || empty($param['gender']))
            return parameter_error_res("gender_missing");

        if (!in_array("breed", $keys) || empty($param['breed']))
            return parameter_error_res("breed_missing");

        if (!in_array("weight", $keys) || empty($param['weight']))
            return parameter_error_res("weight_missing");

        if (!in_array("age", $keys) || empty($param['age']))
            return parameter_error_res("age_missing");

        if (!in_array("color", $keys) || empty($param['color']))
            return parameter_error_res("color_missing");

        if (!in_array("address", $keys) || empty($param['address']))
            return parameter_error_res("address_missing");

        if (!in_array("about", $keys) && empty($param['about']))
            return parameter_error_res("about_missing");

        if (!in_array("pets_category", $keys) && empty($param['pets_category']))
            return parameter_error_res("petcategory_missing");

        if (!in_array("photo_count", $keys) && empty($param['photo_count']))
            return parameter_error_res("photo_count_missing");

        $photo_count = isset($param['photo_count']) ? $param['photo_count'] : 0;

        for ($x = 1; $x <= $photo_count; $x++) {
            if (!isset($_FILES['photo' . $x]['error']) || $_FILES['photo' . $x]['error'] != 0)
                return parameter_error_res("photo_missing");
            if (isset($_FILES['photo' . $x]['error']) && $_FILES['photo' . $x]['error'] == 0) {
                $ext = strtolower(substr($_FILES['photo' . $x]['name'], strrpos($_FILES['photo' . $x]['name'], ".") + 1));
                $allowed_uploads_extensions = $this->CI->config->item("allow_image_upload_extensions");
                if (!in_array($ext, $allowed_uploads_extensions))
                    return parameter_error_res("invalid_image_extension");
            }
        }
        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function getPets($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (in_array("search_key", $keys) && empty($param['search_key']))
            return parameter_error_res("search_key_missing");
        if (!in_array("category_id", $keys) || empty($param['category_id']))
            return parameter_error_res("category_id_missing");
        if (!in_array("start", $keys) || empty($param['start']))
            $param['start'] = 0;
        if (!in_array("len", $keys) || empty($param['len']))
            $param['len'] = 10;

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }


    function getPetscategory($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (in_array("search_key", $keys) && empty($param['search_key']))
            return parameter_error_res("search_key_missing");
        if (!in_array("category_id", $keys) || empty($param['category_id']))
            return parameter_error_res("category_id_missing");
        if (!in_array("start", $keys) || empty($param['start']))
            $param['start'] = 0;
        if (!in_array("len", $keys) || empty($param['len']))
            $param['len'] = 10;

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function savepets($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("pets_id", $keys) || empty($param['pets_id']))
            return parameter_error_res("pets_id_missing");

        if (!in_array("user_id", $keys) || empty($param['user_id']))
            return parameter_error_res("user_id_missing");

        if (!in_array("pets_save", $keys) & empty($param['pets_save']))
            return parameter_error_res("pets_save_missing");

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function getsavepets($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (in_array("search_key", $keys) && empty($param['search_key']))
            return parameter_error_res("search_key_missing");
        if (!in_array("start", $keys) || empty($param['start']))
            $param['start'] = 0;
        if (!in_array("len", $keys) || empty($param['len']))
            $param['len'] = 10;

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function addPetslike($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("pets_id", $keys) || empty($param['pets_id']))
            return parameter_error_res("pets_id_missing");

        if (!in_array("user_id", $keys) & empty($param['user_id']))
            return parameter_error_res("user_id_missing");

        if (!in_array("pets_like", $keys) & empty($param['pets_like']))
            return parameter_error_res("pets_like_missing");

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function PetsShare($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("pets_id", $keys) || empty($param['pets_id']))
            return parameter_error_res("pets_id_missing");

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }

    function PetsComment($param)
    {
        $param = array_map('trim', $param);
        $keys = array_keys($param);
        if (!in_array("pets_id", $keys) || empty($param['pets_id']))
            return parameter_error_res("pets_id_missing");
        if (!in_array("user_id", $keys) || empty($param['user_id']))
            return parameter_error_res("user_id_missing");
        if (!in_array("comment", $keys) || empty($param['comment']))
            return parameter_error_res("pets_comment_missing");

        $iRes = success_res("validation_ok");
        $iRes['data'] = $param;
        return $iRes;
    }
}
