<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  $alert_msg1 = '';    

  //if button insert clicked

  if (isset($_POST['insert'])) {
    

    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $ename = $_POST['extname'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $uname = $_POST['username'];
    $upass = $_POST['password'];
    $office = $_POST['department'];
    $userStatus = $_POST['userStatus'];;
    $account_type = '0';

    $currentDir = getcwd();
    $uploadDirectory = "../dist/img/";

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg','gif',''];

    $fileName = $_FILES['myFiles']['name'];
    $fileSize = $_FILES['myFiles']['size'];
    $fileTmpName = $_FILES['myFiles']['tmp_name'];
    $fileType = $_FILES['myFiles']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFiles']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $uploadDirectory . basename($fileName);

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);


        if ($dipUpload) {
            $alert_msg1 .= ' 
       <div class="table-bordered">
           <i class="icon fa fa-success"></i>
           File has been uploaded
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';


        } else {
            $alert_msg1 .= ' 
       <div class="alert alert-warning alert-dismissible"">
           <i class="icon fa fa-warning"></i>
           An Error Occured;
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

            $btnStatus = 'disabled';
            $btnNew = 'disabled';
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";

        }
    }

    //length of $contact_number
    $con_number = strlen($contact_number);
    
    if ($con_number != 11) {
      $alert_msg .= ' 
          <div class="alert alert-warning alert-dismissible">
              <i class="icon fa fa-warning"></i>
              Contact Number must be 11 digit.
          </div>     
      ';
    }
    else {

      //hash the password
      $hashed_password  = password_hash($upass, PASSWORD_DEFAULT);
      //insert user to database
      $register_user_sql = "INSERT INTO tbl_users SET 
        first_name     = :fname,
        middle_name    = :mname,
        last_name      = :lname,
        email          = :email,
        ext_name       = :ename,
        contact_no     = :contact_number,
        position       = :position,
        username       = :uname,
        userpass       = :upass,
        location       = :filename,
        Department     = :department,
        userStatus     = :userstatus,
        account_type   = :account_type
        ";

      $register_data = $con->prepare($register_user_sql);
      $register_data->execute([
        ':fname'          => $fname,
        ':mname'          => $mname,
        ':lname'          => $lname,
        ':ename'          => $ename,
        ':email'          => $email,
        ':contact_number' => $contact_number,
        ':position'       => $position,
        ':uname'          => $uname,
        ':upass'          => $hashed_password,
        ':filename'       => $fileName,
        ':department'     => $office,
        ':userstatus'     => $userStatus,
        ':account_type'   => 0
      ]);

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              New User Added
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
    }

  }

 

 
?>