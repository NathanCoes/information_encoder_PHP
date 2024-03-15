<?php

    include_once("../encrypter.php");

    if ($_POST){
        $file = $_FILES['file'];
        $type = get_file_type($file['type']);
        
        //Modified this variable if is necessary
        $temp = "temp/";
        
        if (isset($_POST['encrypt'])){
            encrypt_file($file, $type, $temp);
        }
    
        if (isset($_POST['decrypt'])){
            decrypt_file($file, $type, $temp);
        }
    }


    function get_file_type( String $file ) {
        $details = explode("/", $file);
        
        return $details[count($details)-1];
    }

    function encrypt_file($file, $type, $temp){
        $file_dir = $temp.$file['name'];
            
        move_uploaded_file($file['tmp_name'], $file_dir);
        $file_content = file_get_contents($file_dir);
        unlink($file_dir);
        
        $file_content_encrypted =  Encrypter::encrypt($file_content);
        
        $file_content = [
            "type" => $type,
            "file_name" => Encrypter::encrypt($file['full_path']),
            "content" => $file_content_encrypted
        ];

        $file_content = base64_encode(json_encode($file_content));
        $file_name = $file['name'].".enc";
        $file_path = "docs/".$file_name;

        $file = fopen($file_path, "w+") or die ("Oops! Unexpected error");

        session_start();

        if (fwrite($file, $file_content)){

            fclose($file);
            
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"$file_name\""); 
            readfile($file_path);
            unlink($file_path);

        }else{
            $_SESSION['process'] = "error";
            header("LOCATION: index.php");
        }
    }

    function decrypt_file($file, $type, $temp){
        $file_dir = $temp.$file['name'];
            
        move_uploaded_file($file['tmp_name'], $file_dir);
        $file_details = json_decode(base64_decode(file_get_contents($file_dir)));
        unlink($file_dir);

        $file_content_decrypted =  Encrypter::decrypt($file_details->content);
        $file_name = Encrypter::decrypt($file_details->file_name);

        if (strpos($file_name, ".".$file_details->type) == false){
            $file_name = $file_name.".".$file_details->type;
        }

        $file_path = "docs/".$file_name;

        $file = fopen($file_path, "w+") or die ("Oops! Unexpected error");

        session_start();

        if (fwrite($file, $file_content_decrypted)){

            fclose($file);
            
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"$file_name\""); 
            readfile($file_path);
            unlink($file_path);

        }else{
            $_SESSION['process'] = "error";
            header("LOCATION: index.php");
        }
    }

?>