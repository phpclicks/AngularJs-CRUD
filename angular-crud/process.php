<?php
          $db_con = new PDO('mysql:host=localhost;dbname=php_clicks', 'root', '');
		  $errors = array();  // array to hold validation errors
		  $data   = array();        // array to pass back data
		  
   if(!empty($_REQUEST['action']) && $_REQUEST['action'] == "addRecord")	
    {	  
		  // validate the variables ========
		  if (empty($_POST['first_name']))
			$errors['first_name'] = 'First Name is required.';
		  
		  if (empty($_POST['last_name']))
			$errors['last_name'] = 'Last Name is required';
			
			if (empty($_POST['email']))
			$errors['email'] = 'Email is required';
		
		  if (filter_var(isset($_POST['email']), FILTER_VALIDATE_EMAIL) === false && isset($_POST['email'])!="" ) {
     		$errors['email'] = 'Enter Valid Email';
           }	
		  
		  // return a response ==============
		  
		  // response if there are errors
		  if ( ! empty($errors)) {
		  
			// if there are items in our errors array, return those errors
			$data['success'] = false;
			$data['errors']  = $errors;
		  } else {
		  
			// if there are no errors, return a message
		  $sqlQuery = "INSERT INTO 	student(first_name,last_name , email )
		  VALUES(:first_name,:last_name,:email)";		   
		  $run = $db_con->prepare($sqlQuery);
		  $run->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);  
		  $run->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR); 
		  $run->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
		  $run->execute(); 	
		  
		  $data['message']    = "Record added successfully";
		  $data['success'] = true;
		  }
		  echo json_encode($data);
     }
	 else if(!empty($_REQUEST['action']) && $_REQUEST['action'] == "getSingleStudent") 
	 {
	   $fetch_student_info = $db_con->prepare("select first_name,last_name,email,student_id from student where student_id = :student_id");
       $fetch_student_info->execute(array(':student_id' => $_REQUEST['student_id']));
	   $list = $fetch_student_info->fetchAll(PDO::FETCH_ASSOC); 
	   echo json_encode($list);
		 
	 }
	 else if(!empty($_REQUEST['action']) && $_REQUEST['action'] == "updateStudent")
	 {
		$_POST = json_decode(file_get_contents('php://input'), true);
		// validate the variables ========
		  if (empty($_POST['first_name']))
			$errors['first_name'] = 'First Name is required.';
		  
		  if (empty($_POST['last_name']))
			$errors['last_name'] = 'Last Name is required';
			
			if (empty($_POST['email']))
			$errors['email'] = 'Email is required';
		
		  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false && $_POST['email']!="" ) {
     		$errors['email'] = 'Enter Valid Email';
           }	
		  
		  // return a response ==============
		  
		  // response if there are errors
		  if ( ! empty($errors)) {
		  
			// if there are items in our errors array, return those errors
			$data['success'] = false;
			$data['errors']  = $errors;
		  } else {
			  
			//  print_r($_POST);
			// if there are no errors, return a message
		   $sqlQuery = "UPDATE student SET first_name = :first_name, 
            last_name  = :last_name, 
            email  = :email  
            WHERE student_id = :student_id";
		  $run = $db_con->prepare($sqlQuery);
		  $run->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);  
		  $run->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR); 
		  $run->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
		  $run->bindParam(':student_id', $_POST['student_id'], PDO::PARAM_INT);
		  $run->execute();  	
		  $data['message']    = "Record updated successfully";
		  $data['success'] = true;    
		  }

		echo json_encode($data);
		 
	 }
	else if(!empty($_REQUEST['action']) && $_REQUEST['action'] == "getList") 
	{

        // a query get all the records from the users table
        $sql = 'SELECT * FROM student';

        // use prepared statements, even if not strictly required is good practice
        $stmt = $db_con->prepare( $sql );

        // execute the query
        $stmt->execute();

        // fetch the results into an array
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

        // convert to json
       echo  $json = json_encode( $result );
		
	}
	else if(!empty($_REQUEST['action']) &&  $_REQUEST['action'] == "deleteStudent")
	{
		  $sqlQuery = "DELETE FROM student WHERE student_id =  :student_id";
	      $run = $db_con->prepare($sqlQuery);
	      $run->bindParam(':student_id', $_REQUEST['student_id'], PDO::PARAM_INT);   
	      $run->execute();
		  $resp['status'] = true;
		  $resp['msg'] = "Record deleted successfully";
		  echo json_encode($resp);
	}
?>