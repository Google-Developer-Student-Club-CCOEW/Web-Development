<?php
	       
	        $email =filter_input(INPUT_POST, 'email');
	        $password =filter_input(INPUT_POST, 'password');
	if(!empty($email) || !empty($password)){
		$host = "localhost";
		$dbUsername ="root";
		$dbpassword = "";
		$dbname = "shreya";
	    $conn = new mysqli($host,$dbUsername,$dbpassword,$dbname);

	    if(mysqli_connect_error()){
	        die('Connect Error(' . mysqli_connect_errno().')'. mysqli_connect_error());
	    } else{
	    	$SELECT ="SELECT email From login Where email = ? Limit 1";
	    	$INSERT = "INSERT Into login (password,email) values(?,?)";
	    	$stmt = $conn->prepare($SELECT);
	    	$stmt->bind_param("s",$email);
	    	$stmt->execute();
	    	$stmt->bind_result($email);
	    	$stmt->store_result();
	    	$rnum = $stmt->num_rows;


	    	if($rnum==0){
	    		$stmt->close();
	    		$stmt->$conn->prepare($INSERT);
	    		$stmt->bind_param("ss",$email,$password);
	    		$stmt->execute();
	    		echo "new record created sucessfully";
	    	} else{
	    		echo "someone already register using this email";
	    	}
	    	$stmt->close();
	    	$conn->close();


	    }
	}
	    else {
	    	echo "All fields are required";
	    	die();
	    }
	    ?>