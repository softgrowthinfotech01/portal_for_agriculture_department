<?php
 // A list of permitted file extensions
    $allowed = array('png', 'jpg');
     if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

     $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
     if(!in_array(strtolower($extension), $allowed)){
     echo '{"status":"error"}';
     exit;
    }
     $new_name=date('dmYHis').rand(1000,9999).".".$extension;
     if(move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$new_name)){
     $tmp='images/'.$new_name;
     $new = $_SERVER['DOCUMENT_ROOT'].'/admin/images'.$new_name; //adapt path to your needs;
     if(copy($tmp,$new)){
     echo "https://atmamaharashtra.com/admin".'/images'.$new_name;
    //echo '{"status":"success"}';
    }
     exit;
    }
    }
     //echo '{"status":"error"}';
     exit;
    ?>