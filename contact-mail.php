<?php

if(isset($_POST['g-recaptcha-response']))
{
    $secret_key = "6Lc0k6UpAAAAAD1puGVgKQQGzo_ijhBh2UmrJmTb";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip";
    $file = file_get_contents($url);
    // echo $file;
    
    $data = json_decode($file);
    if($data->success==true)
    {
            // $to="info@aptechlearningborivali.com";
			$to="aptechlearningborivali@gmail.com";

			$subject = "Contact Us Enquiry";

			$data='<table border="1" bordercolor="#ccc" align="center" width="650" style="width:650px;" cellpadding="10" cellspacing="0">';

			$data.='<tr><td colspan="2" align="center">Contact Us Enquiry</td></tr>';/* field name */

			$data.='<tr><td>Full Name </td><td>'.$_POST['name'].'</td></tr>';

			$data.='<tr><td> Email ID </td><td>'.$_POST['email'].'</td></tr>';

			$data.='<tr><td> Mobile No</td><td>'.$_POST['phone'].'</td></tr>';

        	$data.='<tr><td> Course </td><td>'.$_POST['course'].'</td></tr>';
        	
        // 	$data.='<tr><td> Message </td><td>'.$_POST['message'].'</td></tr>';

			$data.='</table>';

			$message=$data;

			$headers = "MIME-Version: 1.0" . "\r\n";

			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= 'From: <'.$_POST['email'].'>' . "\r\n";

			header('Content-Type: application/json');

			if(mail($to,$subject,$message,$headers))
			{
                header('Location:success.php');
        	}
			else
			{
			    header('Location:failed.php');
			}

    }
    else
    {
        echo "Please fill Recaptcha";
    }
}
else
{
    echo "Recaptcha Error";
}





?>