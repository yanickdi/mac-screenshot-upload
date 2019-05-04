<?php
    error_reporting(E_ALL & ~E_NOTICE);

    require_once('.settings.php');

    function getUrl($base_url, $file){
        if (substr( $file, 0, 1) == '/'){
            $file = substr($file, 1, strlen($file));
        }
        return $base_url . '/' . $file;
    }

    if(! isset($_FILES['file'])){
        exit('ERROR: file not given');
    }

    if (! isset($_SERVER['HTTP_X_KEY']) || $_SERVER['HTTP_X_KEY'] != $settings['key']){
        exit('ERROR: Authentication Error');
    }

    $uploaded_file = $_FILES['file'];
    $uploaded_file_name = basename($uploaded_file['name']);
    $to_folder_rel =  '/'.$settings['upload_dir'].'/' . date('Y-m-d') . '/' . random_int(9999999999999999, 99999999999999999);
    $to_folder_abs = dirname(__FILE__) . $to_folder_rel;
    if (!file_exists($to_folder_abs)){
        mkdir($to_folder_abs, 0777, true);
    }
    $to_file = $to_folder_abs . '/' .  $uploaded_file_name;

    if (move_uploaded_file($uploaded_file["tmp_name"], $to_file)) {
        echo getUrl($settings['url_to_upload_dir'], $to_folder_rel . '/' . $uploaded_file_name);
    } else {
        exit("ERROR: Could not save uploaded file on the server");
    }
?>

