<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$conn = new mysqli('localhost', 'root', 'youpassword', 'gps');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$pno=$_POST['pno'];
$sender=$_POST['sname'];
$pername=$_POST['cname'];
$cmail=$_POST['email'];
$desg=$_POST['desg'];
$sname=$_POST['sname'];
$smail=$_POST['smail'];
$stm1="SELECT pname FROM projects WHERE pno=?";
$stmt1=$conn->prepare($stm1);
$stmt1->bind_param('s',$pno);
$stmt1->execute();
$stmt1->bind_result($ptitle);
if ($stmt1->fetch()) {
    $pname=$ptitle;
}
else{
    echo "<script>alert('Project Not found on Database. Contact Administrator. Click  Back Button of the page to go to the form.')</script>";
    exit(); 
}
$stmt1->close();
$stm2="SELECT cname FROM projects WHERE pno=?";
$stmt2=$conn->prepare($stm2);
$stmt2->bind_param('s',$pno);
$stmt2->execute();
$stmt2->bind_result($cname);
if ($stmt2->fetch()) {
    $clname=$cname;
}
$stmt2->close();
$stm3="SELECT cno FROM projects WHERE pno=?";
$stmt3=$conn->prepare($stm3);
$stmt3->bind_param('s',$pno);
$stmt3->execute();
$stmt3->bind_result($cno);
if ($stmt3->fetch()) {
    $con_no=$cno;
}
$stmt3->close();
$mail= new PHPMailer(true);
$mail->isSMTP();                              //Send using SMTP
$mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
$mail->SMTPAuth   = true;             //Enable SMTP authentication
$mail->Username   = 'shivaramcvm@gmail.com';   //SMTP write your email
        $mail->Password   = 'ezohfgtxxexhodbi';      //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
        $mail->Port       = 465;
        $mail->setFrom('shivaramcvm@yahoo.in','Madankumar');
        $mail->addAddress($_POST['email']);
$mail->Subject = 'Feedback Form';
$link="http://localhost/GPS/Feedback%20Form.html?name=".urlencode($clname)."&con_no=".urlencode($con_no)."&ptitle=".urlencode($pname)."&pno=".urlencode($pno)."&pername=".urlencode($pername)."&desg=".urlencode($desg)."&sname=".urlencode($sname)."&smail=".urlencode($smail);
$mail->addEmbeddedImage('C:\xampp\htdocs\GPS\WhatsApp Image 2024-07-14 at 10.03.18_edde10e9.jpg', 'image_cid'); 
$mail->Body = <<< EOD
                <html>
                <h4>Kindly take a few minutes to fill out the Customer Feedback Form by clicking on the link below.</h4>
                <a href=$link>Feedback Form</a><br>
                <h5>By</h5>
                <h5>$sender</h5>
                <img src="cid:image_cid">
                </html>
                EOD;
$mail->isHTML(true);
$mail->send();
header("Location: Sender_form.html?status=success");
?>