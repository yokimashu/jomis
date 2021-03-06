<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $emp_fname = $_POST['firstname'];
    $emp_mname = $_POST['middlename'];
    $emp_lname = $_POST['lastname'];
    $emp_ename = $_POST['extname'];
    $emp_code = $_POST['code'];
    $emp_gender = $_POST['gender'];
     $emp_address = $_POST['address'];
    $emp_brgy =  $_POST['brgy'];
    $emp_skills =  $_POST['skills'];
    $emp_civil_status =  $_POST['status'];
    $emp_charges =  $_POST['charges'];
    $emp_status =  $_POST['e_status'];
    $emp_birth = date('Y-m-d', strtotime($_POST['dateBirth']));
    $emp_city =  $_POST['city'];
    $emp_province =  $_POST['province'];
    $emp_designation = $_POST['designation'];
    $emp_dept = $_POST['dept'];
    $emp_startingdate = date('Y-m-d', strtotime($_POST['dateStart']));
    $emp_email = $_POST['email'];
    $emp_eligible =  $_POST['eligibility'];
    $emp_contact_number = $_POST['contact_number'];
    $emp_category =  $_POST['category'];
    $emp_others =  $_POST['others'];
    $emp_remarks =  $_POST['remarks'];
    $emp_place_birth =  $_POST['placebirth'];
    $emp_citizen =  $_POST['citizen'];
    $emp_spousefname = $_POST['spouseFn'];
    $emp_spousemname = $_POST['spouseMn'];
    $emp_spouselname = $_POST['spouseLn'];
    $emp_spouseename = $_POST['spouseEn'];
    $emp_spouse_occ = $_POST['spouseOcc'];
    $emp_child1 = $_POST['child1'];
    $emp_child2 = $_POST['child2'];
    $emp_child3 = $_POST['child3'];
    $emp_child4 = $_POST['child4'];
    $emp_child5 = $_POST['child5'];
    $emp_child_birth1 = date('Y-m-d', strtotime($_POST['childB1']));
    $emp_child_birth2 = date('Y-m-d', strtotime($_POST['childB2']));
    $emp_child_birth3 = date('Y-m-d', strtotime($_POST['childB3']));
    $emp_child_birth4 = date('Y-m-d', strtotime($_POST['childB4']));
    $emp_child_birth5 = date('Y-m-d', strtotime($_POST['childB5']));

    //ID Numbers DETAILS
    $id_sss =  $_POST['sss'];
    $id_pag_ibig =  $_POST['pag_ibig'];
    $id_tin =  $_POST['tin'];
    $id_atm =  $_POST['atm'];
    $id_ctc =  $_POST['ctc'];
    $id_place =  $_POST['ctc_place'];
    $id_date = date('Y-m-d', strtotime($_POST['datectc']));
    $id_phil =  $_POST['philhealth'];


  //EDUCATION DETAILS
    $edu_elemschool =  $_POST['elemschool'];
    $edu_elemyear =  $_POST['elemyear'];
    $edu_elemaward =  $_POST['elemaward'];
    $edu_secschool =  $_POST['secschool'];
    $edu_secyear =  $_POST['secyear'];
    $edu_secaward =  $_POST['secaward'];
    $edu_colschool =  $_POST['colschool'];
    $edu_colyear =  $_POST['colyear'];
    $edu_colaward =  $_POST['colaward'];
    $edu_vocation =  $_POST['vocationalschool'];
    $edu_vocation_year =  $_POST['vocationalyear'];
    $edu_vocation_award =  $_POST['vocationalaward'];
    $edu_graduate =  $_POST['graduateschool'];
    $edu_graduate_year =  $_POST['graduateyear'];
    $edu_graduate_award =  $_POST['graduateaward'];

    //ID Numbers DETAILS
    $id_sss =  $_POST['sss'];
    $id_pag_ibig =  $_POST['pag_ibig'];
    $id_tin =  $_POST['tin'];
    $id_atm =  $_POST['atm'];
    $id_ctc =  $_POST['ctc'];
    $id_place =  $_POST['ctc_place'];
    $id_date = date('Y-m-d', strtotime($_POST['datectc']));
    $id_phil =  $_POST['philhealth'];
  
//EXPERIENCE
    $employer_one_name = $_POST['nameone'];
    $employer_two_name = $_POST['nametwo'];
    $employer_three_name = $_POST['namethree'];
    $employer_one_designation = $_POST['designationone'];
    $employer_two_designation = $_POST['designationtwo'];
    $employer_three_designation = $_POST['designationthree'];
    $employer_one_salary = $_POST['salaryone'];
    $employer_two_salary = $_POST['salarytwo'];
    $employer_three_salary = $_POST['salarythree'];
    $employer_one_work = $_POST['workone'];
    $employer_two_work = $_POST['worktwo'];
    $employer_three_work = $_POST['workthree'];
   
   //PHOTO DETAILS
    $currentDir = getcwd();
    $uploadDirectory = "../dist/photo/";

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
  
    
    $insert_employee_sql  = "INSERT INTO `employeedetail` SET 
    EmpFname       =      :fname,
    EmpMname       =      :mname,  
    EmpLname       =      :lname,
    EmpExt         =      :ename,
    EmpCode        =      :code,
    Others         =      :others,
    EmpPhoto       =      :filename,
    EmpGender      =      :gender,
    EmpAddress     =      :address,
    EmpJoingdate   =      :dateStart,
    EmpBrgy        =      :brgy,
    EmpSkills      =      :skills,
    EmpStatus      =      :status,
    Charges        =      :charges,
    E_Status      =      :e_status,
    EmpBirth       =      :dateBirth,
    PlaceBirth     =      :placebirth,
    EmpCity        =      :city,
    EmpProvince    =      :province,
    EmpContactNo   =      :contact_number,
    EmpEmail       =      :email,
    EmpDesignation =      :designation,
    EmpDept        =      :dept,
    EmpEligible   =       :eligible,
    EmpCitizen   =       :citizen,
    Category      =      :category,
    SpouseFn       =       :spouseFn,
    SpouseLn       =       :spouseLn,
    SpouseMn       =       :spouseMn,
    SpouseEn       =       :spouseEn,
    SpouseOcc       =       :spouseOcc,
    EmpChild1       =       :child1,
    EmpChild2       =       :child2,
    EmpChild3       =       :child3,
    EmpChild4       =       :child4,
    EmpChild5       =       :child5,
    EmpChildB1       =       :childB1,
    EmpChildB2       =       :childB2,
    EmpChildB3       =       :childB3,
    EmpChildB4       =       :childB4,
    EmpChildB5       =       :childB5,
    Remarks        =      :remarks
         ";

      $employee_data = $con->prepare($insert_employee_sql);
      $employee_data->execute([
    ':fname'           =>     $emp_fname,
    ':mname'           =>     $emp_mname,  
    ':lname'           =>     $emp_lname,
    ':ename'           =>     $emp_ename,
    ':code'            =>     $emp_code,
    ':others'            =>     $emp_others,
    ':placebirth'      =>      $emp_place_birth,
    ':filename'        =>     $fileName,
     ':gender'          =>     $emp_gender,
     ':address'         =>     $emp_address,
    ':dateStart'       =>     $emp_startingdate,
    ':brgy'            =>     $emp_brgy,
    ':skills'          =>     $emp_skills,
    ':status'          =>     $emp_civil_status,
     ':charges'          =>    $emp_charges,
    ':e_status'        =>     $emp_status,
    ':dateBirth'       =>     $emp_birth,
    ':city'            =>     $emp_city,
    ':province'        =>     $emp_province,
    ':contact_number'  =>     $emp_contact_number,
    ':email'           =>     $emp_email,
    ':designation'     =>     $emp_designation,
    ':dept'            =>     $emp_dept,
    ':eligible'        =>     $emp_eligible,
    ':citizen'        =>     $emp_citizen,
     ':category'            =>    $emp_category,
     ':spouseFn'          =>    $emp_spousefname,
     ':spouseLn'          =>    $emp_spouselname,
     ':spouseMn'          =>    $emp_spousemname,
     ':spouseEn'          =>    $emp_spouseename,
     ':spouseOcc'          =>    $emp_spouse_occ,
     ':child1'          =>    $emp_child1,
     ':child2'          =>    $emp_child2,
     ':child3'          =>    $emp_child3,
     ':child4'          =>    $emp_child4,
     ':child5'          =>    $emp_child5,
     ':childB1'          =>    $emp_child_birth1,
     ':childB2'          =>    $emp_child_birth2,
     ':childB3'          =>    $emp_child_birth3,
     ':childB4'          =>    $emp_child_birth4,
     ':childB5'          =>    $emp_child_birth5,
      ':remarks'         =>    $emp_remarks
      ]);

      $id_number_sql = "INSERT INTO no SET 
      SssNo     =       :sss,
      PagIbigNo =       :pag_ibig,
      CtcNo     =       :ctc,
      CtcDate   =       :datectc,
      CtcAt     =       :ctc_place,
      AtmNo     =       :atm,
      TinNo     =       :tin,
      PhilNo    =       :philhealth,
      EmpCode   =       :code
        ";
     $id_number_data = $con->prepare($id_number_sql);
     $id_number_data->execute([
    ':sss'            =>     $id_sss,
    ':pag_ibig'       =>     $id_pag_ibig,
    ':ctc'            =>     $id_ctc,
    ':datectc'        =>     $id_date,
    ':ctc_place'      =>     $id_place,
    ':atm'            =>     $id_atm,
    ':tin'            =>     $id_tin,
    ':philhealth'     =>     $id_phil,
    ':code'           =>     $emp_code]);

$registers_education_sql = "INSERT INTO empeducation SET 
      ElementarySchool =      :elemschool,
      ElementaryYear   =      :elemyear,
      ElementaryAward   =      :elemaward,
      SecondarySchool  =       :secschool,
      SecondaryYear    =       :secyear,
      SecondaryAward   =       :secaward,
      SchoolCollegeGra =       :colschool,
      YearPassingGra   =       :colyear,
      CollegeAward     =       :colaward,
      Vocational       =       :vocationalschool,
      VocationalYear   =       :vocationalyear,
      VocationalAward  =       :vocationalaward,
      Graduate         =       :graduateschool,
      GraduateYear     =       :graduateyear,
      GraduateAward    =       :graduateaward,
      EmpCode          =       :code
        ";
      $registers_data = $con->prepare($registers_education_sql);
      $registers_data->execute([
    ':elemschool'           =>     $edu_elemschool,
    ':elemyear'             =>     $edu_elemyear,
    ':elemaward'             =>     $edu_elemaward,
    ':secschool'            =>     $edu_secschool,
    ':secyear'              =>     $edu_secyear,
    ':secaward'              =>     $edu_secaward,
    ':colschool'            =>     $edu_colschool,
    ':colyear'              =>     $edu_colyear,
    ':colaward'              =>     $edu_colaward,
    ':vocationalschool'     =>     $edu_vocation,
    ':vocationalyear'       =>     $edu_vocation_year,
    ':vocationalaward'       =>     $edu_vocation_award,
    ':graduateschool'       =>     $edu_graduate,
    ':graduateyear'         =>     $edu_graduate_year,
    ':graduateaward'         =>     $edu_graduate_award,
    ':code'                 =>     $emp_code]);

 $employer_sql = "INSERT INTO empexperience SET 
      Employer1Name        =       :nameone,
      Employer2Name        =       :nametwo,
      Employer3Name        =       :namethree,
      Employer1Designation =       :designationone,
      Employer2Designation =       :designationtwo,
      Employer3Designation =       :designationthree,
      Employer1CTC         =       :salaryone,
      Employer2CTC         =       :salarytwo,
      Employer3CTC         =       :salarythree,
      Employer1WorkDuration =      :workone,
      Employer2WorkDuration  =     :worktwo,
      Employer3WorkDuration =      :workthree,
     
      EmpCode              =       :code
        ";
     $employer_data = $con->prepare($employer_sql);
     $employer_data->execute([
    ':nameone'              =>     $employer_one_name,
    ':nametwo'              =>     $employer_two_name,
    ':namethree'            =>     $employer_three_name,
    ':designationone'       =>     $employer_one_designation,
    ':designationtwo'       =>     $employer_two_designation,
    ':designationthree'     =>     $employer_three_designation,
    ':salaryone'            =>     $employer_one_salary,
    ':salarytwo'            =>     $employer_two_salary,
    ':salarythree'          =>     $employer_three_salary,
    ':workone'              =>     $employer_one_work,
    ':worktwo'             =>      $employer_two_work,
    ':workthree'           =>      $employer_three_work,
   

    ':code'                 =>     $emp_code]);



      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Successfully Added!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
}
?>

 
