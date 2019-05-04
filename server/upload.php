<?php
    error_reporting(E_ALL & ~E_NOTICE);

    function getUrl($sub_file){
        if (substr( $sub_file, 0, 1) == '/'){
            $sub_file = substr($sub_file, 1, strlen($sub_file));
        }
        $this_url =  str_replace("\\",'/',$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].substr(getcwd(),strlen($_SERVER['DOCUMENT_ROOT'])));
        return $this_url . '/' . $sub_file;
        return $sub_file;
    }

    if(! isset($_FILES['file'])){
        exit('ERROR: file not given');
    }

    $uploaded_file = $_FILES['file'];
    $uploaded_file_name = basename($uploaded_file['name']);
    $to_folder_rel =  '/uploads/' . date('Y-m-d') . '/' . random_int(9999999999999999, 99999999999999999);
    $to_folder_abs = dirname(__FILE__) . $to_folder_rel;
    if (!file_exists($to_folder_abs)){
        mkdir($to_folder_abs, 0777, true);
    }
    $to_file = $to_folder_abs . '/' .  $uploaded_file_name;

    if (move_uploaded_file($uploaded_file["tmp_name"], $to_file)) {
        echo getUrl($to_folder_rel . '/' . $uploaded_file_name);
    } else {
        exit("ERROR: Could not save uploaded file on the server");
    }
?>

