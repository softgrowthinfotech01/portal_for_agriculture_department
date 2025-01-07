<?php
session_start();
require_once "../conn.php";
require_once "check_login.php";
$blog_id=$_SESSION['sess_blog_id'];
if(isset($_POST['submit_question']))
{
   // print_r($_POST);exit;
    extract($_POST);
    
  if($_FILES["blog_title_image"]["tmp_name"]!="")
  {
    $targetDir = "images/slider/"; 
    $allowTypes = array('jpg','png','jpeg'); 

    $fileName = basename($_FILES['blog_title_image']['name']); 
    $arr1=explode('.',$fileName);
    $extension1=strtolower(end($arr1));
    $date1=rand(1000,9999)."_".date('dmYhis').".$extension1";
    $targetFilePath = $targetDir . $fileName; 
          
         // Check whether file type is valid 
         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
         if(in_array($fileType, $allowTypes)){ 
             // Upload file to server 
             if(move_uploaded_file($_FILES["blog_title_image"]["tmp_name"], "../uploaded_images/blog_title_images/".$date1)){
                    $stmt = $conn->prepare("UPDATE blog SET blog_title=:blog_title,blog_title_image=:blog_title_image,blog_text=:blog_text,category_id=:category_id,blog_status=:blog_status WHERE blog_id=:blog_id");
                    $executed=$stmt->execute(array(':blog_title' => $blog_title,':blog_title_image' => $date1,':blog_text' => $blog_text,':category_id' => $category_id,':blog_status' => 1,':blog_id' => $blog_id));
                    if($executed){
                       echo '<script>alert("Blog updated.");window.location.href = "all_blogs";</script>';
                    }
             }
         }
  }
  else
  {
                    $stmt = $conn->prepare("UPDATE blog SET blog_title=:blog_title,blog_text=:blog_text,category_id=:category_id,blog_status=:blog_status WHERE blog_id=:blog_id");
                    $executed=$stmt->execute(array(':blog_title' => $blog_title,':blog_text' => $blog_text,':category_id' => $category_id,':blog_status' => 1,':blog_id' => $blog_id));
                    if($executed){
                       echo '<script>alert("Blog updated.");window.location.href = "all_blogs";</script>';
                    }
  }
}
$stmt_blog = $conn->prepare("SELECT * FROM blog WHERE blog_id=".$blog_id);
$stmt_blog->execute();
$row_blog = $stmt_blog->fetchAll(PDO::FETCH_ASSOC);
//print_r($row_blog);exit;
//echo '<script>alert("System is under maintainance for sometime. Please try again after later.");window.location.href = "logout";</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ATMA | View Blog</title>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- include summernote css/js -->

  <!-- Google Font: Source Sans Pro -->
  
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
  @font-face {
    font-family: 'krutidev';
    src: url('k010.woff') format('woff2');
    font-weight: normal;
    font-style: normal;

}
  @font-face {
    font-family: 'Devanagari';
    src: url('Devanagari.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}
#blog_text{
    /*font-family: 'krutidev';*/
}
    .someData{
			display:none;
		    padding: 1%;
		}
		
		.activeTab{
			display:block;
		}
  </style>
</head>
<body class="hold-transition sidebar-mini">
      <?php require_once 'header.php';?>
      
       <div class="content-wrapper mt-5">
           <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                           <h3 class="card-title">View Blog</h3>
                      </div>
                          <div class="card-body">
                              <form method="post" action="" enctype="multipart/form-data" onsubmit="return func_add_blog(this)">
                                 
                                <div class="card-body col-md-12 mx-auto border mb-3">
                                    
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php
                                        $stmt_category_list = $conn->prepare("SELECT * FROM category ORDER BY category_id DESC");
                                        $stmt_category_list->execute();
                                        $row_category_list = $stmt_category_list->fetchAll(PDO::FETCH_ASSOC);
                                        for($c=0;$c<count($row_category_list);$c++)
                                        {
                                            ?>
                                            <option value="<?php echo $row_category_list[$c]['category_id'];?>" <?php if($row_blog[0]['category_id']==$row_category_list[$c]['category_id'])echo "selected";?>><?php echo $row_category_list[$c]['category_name'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Old Blog Title Image</label>
                                    <div class="input-group">
                                      <?php
                                      if($row_blog[0]['blog_title_image']=="")
                                      {
                                          ?>
                                          <img src="../assets/images/picture-not-available.jpg" style="height:100px;width:100px;">
                                          <?php
                                      }
                                      else
                                      {
                                          ?>
                                          <img src="../uploaded_images/blog_title_images/<?php echo $row_blog[0]['blog_title_image'];?>" style="height:100px;width:100px;">
                                          <?php
                                      }
                                      ?>
                                      
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Blog Title Image</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="blog_title_image"  name="blog_title_image" accept="image/jpg, image/jpeg, image/png">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Blog Title
                                    </label>
                                        <span class="ml-5">
                                            <div class="someData activeTab" id="div_title_summernote">
                                            	 <textarea name="blog_title" id="blog_title" class="editor"></textarea>
                                            </div>
                                        </span>
                                    
                                   
                                  </div>
                                  <div class="form-group">
                                    <label for="">Blog
                                    </label>
                                        <span class="ml-5">
                                            <div class="someData activeTab" id="div_question_summernote">
                                            	 <textarea name="blog_text" id="blog_text" class="editor"></textarea>
                                            </div>
                                        </span>
                                    
                                   
                                  </div>
                                </div>
                                <!-- /.card-body -->
                
                               <!-- <div class="card-footer">
                                  <button type="submit" class="btn btn-primary" name="submit_question">Submit</button>
                                </div>-->
                              </form>
              <script>
                  function func_add_blog(frm)
                  {
                          //now check id question text is filled
                          if(document.getElementById('blog_text').value=="")
                          {
                              alert('Please fill all fields.');
                              return false;
                          }
                  }
              </script>
                          </div>
                    </div>
                  </div>
                </div>
              </div>
           </section>
       </div>

    <script>
    
    $(document).ready(function () {
        $('#blog_text').summernote({
           
            tabsize: 2,
            height: 500,
            maxTextLength:1000,
        fontNames: ['Arial', 'Times New Roman', 'Devanagari','krutidev'],
        fontNamesIgnoreCheck: ['Arial', 'Times New Roman', 'Devanagari','krutidev'],
        addDefaultFonts: false,
            toolbar: [
              ['style', ['style']],
              ['fontname', ['fontname']],
              ['font', ['bold', 'underline', 'italic','clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['picture']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ] ,
            callbacks: {
                onImageUpload: function(files, editor, $editable) {
                    //alert(files);
                  question_sendFile(files[0],editor,$editable);
                  } ,
                  onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        $('#blog_text').summernote('code', '<?php echo $row_blog[0]['blog_text'] ?>');
        function question_sendFile(file,editor,welEditable) {
          data = new FormData();
          data.append("file", file);
          $.ajax({
           url: "uploader.php",
           data: data,
           cache: false,
           contentType: false,
           processData: false,
           type: 'POST',
           success: function(data){
           //alert(data);
            $('#blog_text').summernote("insertImage", data, 'filename');
            
            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        },
           error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus+" "+errorThrown);
          }
        });
        }

$('#blog_title').summernote({
           
            tabsize: 2,
            height: 50,
            maxTextLength:100,
        fontNames: ['Arial', 'Times New Roman', 'Devanagari','krutidev'],
        fontNamesIgnoreCheck: ['Arial', 'Times New Roman', 'Devanagari','krutidev'],
        addDefaultFonts: false,
            toolbar: [
              ['fontname', ['fontname']]
              ],
            callbacks: {
                onImageUpload: function(files, editor, $editable) {
                    //alert(files);
                  question_sendFile(files[0],editor,$editable);
                  } ,
                  onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
       $('#blog_title').summernote('code', '<?php echo $row_blog[0]['blog_title'] ?>');
    });


    </script>                 
                  <script>
                      function checkImageDetails(img,file_id)
                      {
                          var fileName =img.files[0]['name'];
                          var filePath = fileName.value;
                            // Allowing file type
                            var allowedExtensions =/(\.jpg|\.jpeg|\.png)$/i;
                                    
                            //get image size
                            var fileSize =img.files[0]['size'];
                             
                            if (!allowedExtensions.exec(fileName)) {
                                alert('File not supported. Please enter only .jpg or .png image.');
                                $("#"+file_id).val('');
                                return false;
                            }
                           
                            // Allowing file type
                            var allowedExtensions =/(\.jpg|\.jpeg|\.png)$/i;
                                    
                            //get image size
                            var fileSize =img.files[0]['size'];
                             
                            if (!allowedExtensions.exec(fileName)) {
                                alert('File not supported. Please enter only .jpg or .png image.');
                                
                                $("#"+file_id).val('');
                                return false;
                            }
                            else
                            {
                                //check image size is below 2MB
                                if(fileSize<=200000<?php //echo $row_restrictions[0]['max_file_size_in_kb'];?>)
                                {
                                    
                                }
                                else
                                {
                                    alert('Image size should be less than 2MB.');
                                    
                                    $("#"+file_id).val('');
                                    return false;
                                }
                            }
                      }
                  </script> 

</body>
</html>
