<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
      http_response_code(400);
      $res = array('message' => 'Некорректный email');
      echo json_encode($res);
      die() ;
    }
		$name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $message = trim($_POST['message']);
    $messenger = trim($_POST['messenger']);
    $tel = trim($_POST['tel']);
    $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'X-Mailer: PHP/' . phpversion();

    $body = "<html><body>";
    $body .= "<p>Имя: $name</p>";
    $body .= "<p>Электронная почта: $email</p>";
    $body .= "<p>Телефон: $tel</p>";
    $body .= "<p>Сообщение: $message</p>";
    $body .= "<p>Ответить в Whatsapp или Telegram: $messenger</p>";
    $body .= "</body></html>";
      $emailTo = $_POST['sendto'];
			mail($emailTo, $subject, $body, $headers);
      echo "after wp_mail";
	// if(trim($_POST['tel']) === '') {
	// 	$Error = __('Please enter your phone.','onetone');
	// 	$hasError = true;
	// } else {
	// 	$tel = trim($_POST['tel']);
	// }

	// if(trim($_POST['email']) === '')  {
	// 	$Error = __('Please enter your email address.','onetone');
	// 	$hasError = true;
	// } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
	// 	$Error = __('You entered an invalid email address.','onetone');
	// 	$hasError = true;
	// } else {
	// 	$email = trim($_POST['email']);
	// }

	// if(trim($_POST['message']) === '') {
	// 	$Error =  __('Please enter a message.','onetone');
	// 	$hasError = true;
	// } else {
	// 	if(function_exists('stripslashes')) {
	// 		$message = stripslashes(trim($_POST['message']));
	// 	} else {
	// 		$message = trim($_POST['message']);
	// 	}
	// }

	// $messenger = trim($_POST['messenger']);
		

	// if(!isset($hasError)) {
		
	//    if (isset($_POST['sendto']) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim(base64_decode($_POST['sendto'])))) {
	//    		$emailTo = base64_decode($_POST['sendto']);
	//    }
	//    else{
	// 		 $emailTo = get_option('admin_email');
	// 	}
	//    if($emailTo !=""){
			
	// 		$emailSent = true;
	// 	}
	// 	echo json_encode(array("msg"=>__("Your message has been successfully sent!","onetone"),"error"=>0));
		
	// }
	// else
	// {
	//     echo json_encode(array("msg"=>$Error,"error"=>1));
	// }
	//     die() ;
	}