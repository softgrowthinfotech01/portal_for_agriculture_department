<?php
 // A list of permitted file extensions
    $allowed = array('png', 'jpg','jpeg');
     if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

     $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
     if(!in_array(strtolower($extension), $allowed)){
     echo '{"status":"error"}';
     exit;
    }
     $new_name=date('dmYHis').rand(1000,9999).".".$extension;
     if(move_uploaded_file($_FILES['file']['tmp_name'],'../uploaded_images/'.$new_name)){
   
     echo "https://atmamaharashtra.com/uploaded_images/".$new_name;
    
    }
    else
    {
        echo "There is some error in image upload. Please try again later.";
    }
    }
     
     exit;
    ?>