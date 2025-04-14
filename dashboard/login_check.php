<?php

include('login.php');
$email = $_POST['email'];
$password = $_POST['password'];
$token = $_POST['token'];

// call curl to POST request 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaToken");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6Lee9BUrAAAAAN1Cjo55KYoVAhbnCuQxKlJWrvHs', 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);
//print_r($arrResponse); 
// verify the response 
if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.5) {
    // valid submission 
    // demo purpose
	
	include "database/db.php";
	$query = "select * from register where email='".$email."' and password='".$password."' ";
	$result = mysqli_query($con,$query);
	$rowcount=mysqli_num_rows($result);
	if($rowcount>=1)
	{
		$data = array(
				'status' => true,
				'score' => $arrResponse["score"],
				'msg' => 'Login successfully.',
			);	
	} else {
		$data = array(
				'status' => true,
				'score' => $arrResponse["score"],
				'msg' => 'Invalid login credentials.',
			);
	}
} else {
    // spam submission 
    // show error message 
	$data = array(
				'status' => true,
				'score' => $arrResponse["score"],
				'msg' => 'Spam submission.',
			);
}
echo json_encode($data);	
?>