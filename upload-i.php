<?php
session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
/*Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
//Check if $uploadOk is set to 0 by an error
*/
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
$name = "images/".$_FILES["fileToUpload"]["name"];

 if(exec("python test.py $name",$output,$ret_code))
     {
        $hash =  $output[0];
        //PUSH INTO THE DB  FINALLY ! 
        require_once('dbconnect.php');
        $con = dbconnect();

        $query= mysqli_query($con,"SELECT * from files WHERE hash='$hash'");

    $query = mysqli_num_rows($query);


    if($query == NULL)
    {
       if(mysqli_query($con ,"INSERT INTO files values ('','$name','$hash','$id')"))
       {
        echo "uploaded";
       }
       else {
        echo "not ";
       }
    }
    else {
         $query= mysqli_query($con,"SELECT * from files WHERE hash ='$hash'");

         $q= mysqli_num_rows($query);

         $data = array();
         while($result=mysqli_fetch_assoc($query))
         {

         array_push($data,
            $result['name']
         );
        


 
         }
            $json = json_encode($data);
            $json=  escapeshellarg($json);
            //echo $json;

             if(exec("python imgcmp.py $q $name $json", $output1 , $ret_code ))
                echo "Python Executed ";
            
            else 
                echo "Done ! ";
            //echo $output1[1];
       
        if($output1[1] == 0 )
                {
                   
                 if(mysqli_query($con ,"INSERT INTO files values ('','$name','$hash','$id')")) {

                    echo "This- File Was Uploaded";


                }
                else {
                    echo "Didnt get inserted";


                }  

        }
       else{
                echo "Already File exits,";
                $name= $output1[0];
                 if(mysqli_query($con ,"INSERT INTO files values ('','$name','$hash','$id')")) {

                    echo "We'll just reference it to your Account ......Changed File Path";
                    ?> <button class="btn btn-lg"> <a href="<?php echo $name ?>"> View File </a> </button><?php
                    unlink($target_file);

                }
                else {
                    echo "Didnt get Inserted";
                    

                }              

       }




    }
}

}


?>