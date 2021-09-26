<?php
// Session start
session_start();
// Import the PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// IMport the necessary files
require_once("vendor/autoload.php");
require("includes/functions.php");

function forgotpassword(){
  // Instantiation and passing data
$email = $_SESSION['adminemail'];
$subject ="Password Recovery";
// Generate OTP
$_SESSION['OTP']=$OTP = generateNumericOTP();
// Text to be sent
$message = "<p style='color: black'>Hi <span style='color: black; font-size: 15px'>".$_SESSION['adminname']."</span>,</p>

<p style='color: black'>We received a request to access yourAccount ".$_SESSION['adminemail'].". Your verification code is: </p>

<p style='color: Blue; font-size: 20px'>".$OTP."</p>

<p style='color: black'>If you did not request for this code, it is possible that someone else is trying to access the Account ".$_SESSION['adminemail'].". Do not forward or give this code to anyone.</p>


<p style='color: black'>Sincerely yours,</p>

<p style='color: black'>The Smart Farming Accounts team.</p>";

// Create new PHPMailer object
 $mail = new PHPMailer();

  $mail->isSMTP(true);                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'bervinitsolutions@gmail.com';                     // SMTP username
  $mail->Password   = '1Bervin@6154';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients

  $mail->setFrom($email, "Smart Farm");
  $mail->addAddress($_SESSION['adminemail']);     // Add a recipient

  // Attachments

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body    = $message;
  
  if($mail->send()){
    // If sent alert the user
      echo "<script>alert('A One Time Password (OTP) has been sent to your email');</script>";
      // Record timestamp
      $_SESSION['OTPTime'] = date("Y-m-d H:i:s");
      echo "<script type='text/javascript'> document.location ='confirm-otp.php';</script>";
    //   echo "<script type='text/javascript'> document.location ='confirm-otp.php';</script>";
  }else{
    echo "<script>alert('Could not send email please check your internet connection');</script>";
  }

}

function account_creation($admin_email, $new_admin_Name, $new_admin_Phonenumber, $new_admin_email){
  $Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm");
  $result=$Conn->query("SELECT * FROM admin WHERE Admin_email='$admin_email'");
  $row = $result->fetch_assoc();
    // Instantiation and passing data
$email = $admin_email;
$subject ="New Account Creation";
// Generate OTP
$_SESSION['newaccountotp']=$OTP = generateNumericOTP();
// Text to be sent
$message = "<p style='color: black'>Hi <span style='color: black; font-size: 15px'>".$row['Admin_name']."</span>,</p>

<p style='color: black'>We received a request to create a new Smart Farm Admin Account, with the following details </p>
<p style='color: black'>Full Name: ".$new_admin_Name."</p>
<p style='color: black'>Email Address: ".$new_admin_email."</p>
<p style='color: black'>Phone Number: ".$new_admin_Phonenumber." </p>
<p style='color: black'> authorized by you ".$admin_email." through your email address. Your account verification code is: </p>

<p style='color: Blue; font-size: 20px'>".$OTP."</p>

<p style='color: black'>If you did not request for this code, it is possible that someone else is trying to create an Account using your email as an authorizer. Do not forward or give this code to anyone.</p>


<p style='color: black'>Sincerely yours,</p>

<p style='color: black'>The Smart Farming Accounts team.</p>";

// Create new PHPMailer object
 $mail = new PHPMailer();

  $mail->isSMTP(true);                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'bervinitsolutions@gmail.com';                     // SMTP username
  $mail->Password   = '1Bervin@6154';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients

  $mail->setFrom($email, "Smart Farm");
  $mail->addAddress($admin_email);     // Add a recipient

  // Attachments

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body    = $message;
  if($mail->send()){
    // If sent alert the user
      echo "<script>alert('A One Time Password (OTP) has been sent to your email');</script>";
       // Record timestamp
       $_SESSION['OTPTime'] = date("Y-m-d H:i:s");
      echo "<script type='text/javascript'> document.location ='confirm-otp.php';</script>";
    //   echo "<script type='text/javascript'> document.location ='confirm-otp.php';</script>";
  }else{
    echo "<script>alert('Could not send email please check your internet connection');</script>";
  }


}
if(isset($_SESSION['forgotpassword'])){
  forgotpassword();
  unset($_SESSION['forgotpassword']);
}else{
 
  account_creation($_SESSION['adminauthorizer'],$_SESSION['newadminname'],$_SESSION['newadminmobno'],$_SESSION['newadminemail'] );
}
 
?>