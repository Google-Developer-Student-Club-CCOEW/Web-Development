<?php
	        $name = filter_input(INPUT_POST, 'name');
	        $email =filter_input(INPUT_POST, 'email');
	        $password =filter_input(INPUT_POST, 'password');
	        $phone = filter_input(INPUT_POST, 'phone');
	        $city = filter_input(INPUT_POST, 'city');
	        $state = filter_input(INPUT_POST, 'state');
	        $address =filter_input(INPUT_POST, 'address');
	if(!empty($name) || !empty($email) || !empty($password) || !empty($state) || !empty($phone) || !empty($city) || !empty($address)){
		$host = "localhost";
		$dbUsername ="root";
		$dbpassword = "";
		$dbname = "shreya";
	    $conn = new mysqli($host,$dbUsername,$dbpassword,$dbname);

	    if(mysqli_connect_error()){
	        die('Connect Error(' . mysqli_connect_errno().')'. mysqli_connect_error());
	    } else{
	    	$SELECT ="SELECT email From signup Where email = ? Limit 1";
	    	$INSERT = "INSERT Into signup (name,email,password,state,phone,city,address) values(?,?,?,?,?,?,?)";
	    	$stmt = $conn->prepare($SELECT);
	    	$stmt->bind_param("s",$email);
	    	$stmt->execute();
	    	$stmt->bind_result($email);
	    	$stmt->store_result();
	    	$rnum = $stmt->num_rows;


	    	if($rnum==0){
	    		$stmt->close();
	    		$stmt->$conn->prepare($INSERT);
	    		$stmt->bind_param("sssisss",$email,$name,$password,$phone,$state,$city,$address);
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