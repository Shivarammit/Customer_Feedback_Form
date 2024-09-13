<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
    $cname=$_POST['cname'];
    $con_no=$_POST['con_number'];
    $ptitle=$_POST['ptitle'];
    $pno=$_POST['pno'];
    $clname=$_POST['emp_name'];
    $desg=$_POST['desg'];
    $conn=new mysqli('localhost','root','youpassword','gps');
    $b1=(int)$_POST['text1'];
    $b2=(int)$_POST['text2'];
    $b3=(int)$_POST['text3'];
    $b4=(int)$_POST['text4'];
    $b5=(int)$_POST['text5'];
    $b6=(int)$_POST['text6'];
    $b7=(int)$_POST['text7'];
    $b8=(int)$_POST['text8'];
    $b9=(int)$_POST['text9'];
    $b10=(int)$_POST['text10'];
    $sname=$_POST['sname'];
    $smail=$_POST['smail'];
    $com=$_POST['comments'];
    $img=$_FILES['myfile']['name'];
    $tmp=$_FILES['myfile']['tmp_name'];
    $folder='C:/xampp/htdocs/GPS/Signature/'.$img;
    move_uploaded_file($tmp,$folder);
    $avg=($b1+$b2+$b3+$b4+$b5+$b6+$b7+$b8+$b9+$b10)/10.0;
    $check="SELECT * FROM feedback WHERE con_no=? AND fill_date=DATE(SYSDATE()) and cname=?";
    $stcheck=$conn->prepare($check);
    $stcheck->bind_param('ss',$con_no,$cname);
    $stcheck->execute();
    $result=$stcheck->get_result();
    if($result->num_rows > 0){
        echo '<script>alert("You have already filled the form try again the next day")</script>';
        exit();
    }
    else{
        $sql1="INSERT INTO feedback(cname,con_no,ptitle,pno,clname,cldes,fill_date,avg,signature,sname,smail) VALUES (?,?,?,?,?,?,SYSDATE(),?,?,?,?)";
        $stmt1= $conn->prepare($sql1);
        $stmt1->bind_param("ssssssisss",$cname,$con_no,$ptitle,$pno,$clname,$desg,$avg,$img,$sname,$smail);
        $sql2="INSERT INTO rating(con_no,clname,fill_date,resource_management,comet_staff,pro_sched,quality_doc,quality_man,hse_man,com_res,bus_rel,res_var,cus_focus,comments) VALUES (?,?,SYSDATE(),?,?,?,?,?,?,?,?,?,?,?)";
        $stmt2=$conn->prepare($sql2);
        $stmt2->bind_param("ssiiiiiiiiiis",$con_no,$clname,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$com);
        $stmt1->execute();
        $stmt2->execute();
        $stmt1->close();
        $stmt2->close();
        $date = date("d-m-Y");
        $mail= new PHPMailer(true);
        $mail->isSMTP();                              //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;             //Enable SMTP authentication
        $mail->Username   = 'shivaramcvm@gmail.com';   //SMTP write your email
        $mail->Password   = 'ezohfgtxxexhodbi';      //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
        $mail->Port       = 465;
        $mail->setFrom('shivaramcvm@yahoo.in','Madankumar');
        $mail->addAddress('shivmadan2005@gmail.com');
        $mail->addAddress('madankumar@gpsoman.com');
        $mail->Subject = 'Feedback From '.$cname.' - '.$pno; 
        $mail->addEmbeddedImage($folder, 'image_cid');  
        $mail->Body    = <<<EOD
                            <html>
                            <head>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            </head>
                            <body>
                                <div class="elem">
                                <h4>Project Details</h4>
                                <table style='border-collapse: collapse; margin-top: -30px; border: 3px solid black;'>
                                <tr>
                                    <td style='border: 1px solid black;'>Customer Name:</th><td style='border: 1px solid black; width: 500px;'>$cname</td>
                                    </tr>
                               <tr>
                                <td style='border: 1px solid black; width:200px;'>Contract Number:</td><td style='border: 1px solid black; width: 500px;'>$con_no</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Project Title:</td><td style='border: 1px solid black'>$ptitle</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>GPS Project Number:</td><td style='border: 1px solid black'>$pno</td>
                                </tr>
                                </table><br>
                                <h4>Rating against Performance</h4>
                                <table style="border-collapse: collapse; border: 3px solid black; margin-top: -14px;">
                                <tr>
                                <td style='border: 1px solid black; width: 300px;'>Resource Management</td><td style='border: 1px solid black; width: 100px;'>$b1</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Cometence of staff and Workforce</td><td style='border: 1px solid black'>$b2</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Project Schedule Management</td><td style='border: 1px solid black'>$b3</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Quality of the dicuments Produced</td><td style='border: 1px solid black'>$b4</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Quality Management in Project Execution</td><td style='border: 1px solid black'>$b5</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>HSE Management</td><td style='border: 1px solid black'>$b6</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Communication and Responsiveness</td><td style='border: 1px solid black'>$b7</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Business Relationships</td><td style='border: 1px solid black'>$b8</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Response to Variations</td><td style='border: 1px solid black'>$b9</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Customer Focus</td><td style='border: 1px solid black'>$b10</td>
                                </tr>
                                <tr>
                                    <td style='border: 1px solid black; font-size: large; font-weight: bolder;'>Total Average</td><td style='border: 1px solid black; font-size: large; font-weight: bolder;'>$avg</td>
                                </tr>
                                </table>
                                <br>
                                <h4>Remarks</h4>
                                <p style="border: 3px solid black; width: 700px; height: 80px; margin-top: -15px;">$com</p>
                                </tr><br>
                                <table style="border-collapse: collapse; border: 3px solid black;">
                                <tr>
                                <td style='border: 1px solid black; width: 150px;'>Name</td><td style='border: 1px solid black; width: 550px;'>$clname</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Designation</td><td style='border: 1px solid black;'>$desg</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Date</td><td style='border: 1px solid black;'>$date</td>
                                </tr>
                                <tr>
                                <td style='border: 1px solid black;'>Signature</td><td style='border: 1px solid black;'><img src="cid:image_cid" style="width:200px; height:30px;"></td>
                                </tr>
                                </table>
                                </div>
                                <button class="download" onclick="generatepdf()">Download PDF</button>
                            </body>
                            <script src="download.js">
                            </script>
                        </html>
        EOD;                
        $mail->isHTML(true);
        $mail->send();
        header("Location: Feedback Form.html?status=success");
        $conn->close();
    }
?>