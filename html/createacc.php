<?php
	$config = parse_ini_file('../config.ini');
	mysql_connect($config['endpoint'],$config['username'],$config['password']);
	mysql_select_db($config['dbname']);
	
	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$weight = $_REQUEST['weight'];
	$height = $_REQUEST['height'];
	$email = $_REQUEST['email'];
	$dob_day = $_REQUEST['dob_day'];
	$dob_month = $_REQUEST['dob_month'];
	$dob_year = $_REQUEST['dob_year'];
	$gender = $_REQUEST['gender'];
	$IsSameEmail = mysql_query("select * from user where email ='".$email."'");
	if(mysql_num_rows($IsSameEmail) > 0){
		echo 2;
		mysql_close(); 
		return;
	} 
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 5;
		mysql_close();
		return;            
	} 
	$passkey = password_hash($_REQUEST['passkey'],PASSWORD_DEFAULT);
		
	$query = "INSERT INTO user (first_name,last_name,weight,height,email,passkey,dob_day,dob_month,dob_year,gender) VALUES ('$first_name','$last_name','$weight','$height','$email','$passkey','$dob_day','$dob_month','$dob_year','$gender')";
	$result = mysql_query($query);
	if(!$result){
		echo 1;
		mysql_close();
		return;
	}
	mysql_close();
	echo 0;	
?>